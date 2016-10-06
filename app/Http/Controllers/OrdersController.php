<?php

namespace App\Http\Controllers;

use App\Components\ExcelExport;
use App\Components\Orders;
use App\Floor;
use App\Order;
use App\Time;
use App\Window;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use PDF;

use App\Http\Requests;
use Jleon\LaravelPnotify\Notify;
use Pingpp\Charge;
use Pingpp\Pingpp;

class OrdersController extends Controller
{

    /**
     *
     */
    public function payStatus()
    {
        $event = json_decode(file_get_contents("php://input"));

        // 对异步通知做处理
        if (!isset($event->type)) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
            exit("fail");
        }
        switch ($event->type) {
            case "charge.succeeded":
                // 开发者在此处加入对支付异步通知的处理代码
                $order_no = $event->data->object->order_no;
                Order::where('order_no', $order_no)->update(['status' => '已付款']);
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                break;
            case "refund.succeeded":
                // 开发者在此处加入对退款异步通知的处理代码
                header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
                break;
            default:
                header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
                break;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handleOrder(Request $request)
    {
        Pingpp::setApiKey(env('PING_API_KEY'));
        $charge = Charge::create(
            array(
                'order_no' => time() . rand(1000, 99999),
                'amount' => '100',
                'app' => array('id' => env('PING_APP_ID')),
                'channel' => 'alipay',
                'currency' => 'cny',
                'client_ip' => $request->ip(),
                'subject' => 'Xicode_demo',
                'body' => '1',
//                'extra'     => ['extern_token']
            )
        );
        return $charge;
    }


    /**
     * @param $type
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function printOrders($type)
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second);

        $morningDeliverTime = Time::find(1)->time;
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('早餐'))->second);
        $noonDeliverTime = Time::find(2)->time;

        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('午餐'))->second);
        $afterDeliverTime = Time::find(3)->time;

        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second);
        $timeNow = Carbon::now()->toTimeString();
        switch ($type) {
            case 1:
                if ($timeNow <= $morningDeliverTime) {
                    $orders = $this->getPrintResult($lastDayTime, $todayMorningTime);
                } elseif ($timeNow >= $morningDeliverTime && $timeNow <= $noonDeliverTime) {
                    $orders = $this->getPrintResult($todayMorningTime, $todayNoonTime);
                } elseif ($timeNow >= $noonDeliverTime) {
                    $orders = $this->getPrintResult($todayNoonTime, $todayAfterTime);
                }
                if (!isset($orders)) {
                    flash('当前无订单，不能打印！', 'error');
                    return back();
                }
                ExcelExport::exportWindowDetail($orders);
                break;
            case 2:
                $windows = \App\Window::has('dishes')->get();
                foreach ($windows as $window) {
                    //所有有菜的窗口
                    foreach ($window->dishes as $dish) {
                        //窗口下所有的菜
                        //该菜的所有订单
                        $orders = ExcelExport::getOrders($dish);
                        if (count($orders) != 0) {
                            foreach ($orders as $order) {
                                for ($i = 0; $i < $order->pivot->num; $i++) {
                                    $dish_detail[] = [
                                        'canteen_name' => $dish->window->canteen->name,
                                        'window_name' => $dish->window->name,
                                        'dish_name' => $dish->name,
                                        'dish_price' => $dish->price,
                                        'user_name' => $order->user_name,
                                        'user_phone' => $order->user_phone,
                                        'typeone' => $order->pivot->typeone,
                                        'typetwo' => $order->pivot->typetwo,
                                        'typethree' => $order->pivot->typethree,
                                        'typefour' => $order->pivot->typefour,
                                        'taste' => $order->pivot->taste,
                                        'tableware' => $order->pivot->tableware,
                                        'address' => $order->dormitory->floor->building->name . '-' . $order->dormitory->floor->name .
                                            '-' . $order->dormitory->name,
                                    ];
                                }
                            }
                        }
                    }
                }
                if (isset($dish_detail)){
                    $dishes = $dish_detail;
                }else{
                    Flash::error('当前时间段无订单。');
                    return redirect()->to('orders/today');
                }
                $pdf = PDF::loadView('excels.tags', compact('dishes'));
                return $pdf->download('tags.pdf');
                break;
            case 3:
                if ($timeNow <= $morningDeliverTime) {
                    $orders = $this->getDormitoryResult($lastDayTime, $todayMorningTime);
                } elseif ($timeNow >= $morningDeliverTime && $timeNow <= $noonDeliverTime) {
                    $orders = $this->getDormitoryResult($todayMorningTime, $todayNoonTime);
                } elseif ($timeNow >= $noonDeliverTime) {
                    $orders = $this->getDormitoryResult($todayNoonTime, $todayAfterTime);
                }
                if (!isset($orders)) {
                    Notify::error('非三餐时间不能打印！');
                    return back();
                }
                ExcelExport::exportDormitoryDetail($orders);
                break;
            case 4:
                $orders = Order::where('created_at', '>=', Carbon::createFromDate()->startOfMonth())
                    ->where('status', '已付款')->get();
                ExcelExport::exportSaleDetail($orders);
                break;
            case 5:
                $windows = Window::has('dishes')->get();
                ExcelExport::exportWindowSaleDetail($windows);
                break;
            case 6:
                $floors = Floor::has('dormitories')->get();
                ExcelExport::exportFloorOrderDetail($floors);
                break;
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTodayOrders()
    {
        $orders = Order::where('created_at', '<=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second))->where('created_at', '>=', Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->hour, Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->minute
            , Carbon::createFromFormat('H:i:s', Cache::get('晚餐'))->second))->where('status', '已付款')->paginate(10);

        return view('orders.today', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWeekOrders()
    {
        $orders = Order::where('created_at', '>=', Carbon::createFromDate()->startOfWeek())->where('status', '已付款')->paginate(10);

        return view('orders.week', compact('orders'));
    }

    public function getMonthOrders()
    {
        $orders = Order::where('created_at', '>=', Carbon::createFromDate()->startOfMonth())->where('status', '已付款')->paginate(10);

        return view('orders.month', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHistoryOrders()
    {
        $orders = Order::where('status', '已付款')->paginate(10);

        return view('orders.history', compact('orders'));
    }

    /**
     * @param $time1
     * @param $time2
     * @return array
     */
    public function getPrintResult($time1, $time2)
    {
        $orders = Order::with('dishes')->where('created_at', '>=', $time1)->where('created_at', '<=', $time2)
            ->where('status', '已付款')->get();

        return $orders;
    }

    /**
     * @param $time1
     * @param $time2
     * @return mixed
     */
    public function getTagsResult($time1, $time2)
    {
        $windows = Window::has('dishes')->get();
        return $windows;
    }

    /**
     * @param $time1
     * @param $time2
     * @return mixed
     */
    public function getDormitoryResult($time1, $time2)
    {
        $orders = Order::where('created_at', '>=', $time1)->where('created_at', '<=', $time2)
            ->where('status', '已付款')->get();
        return $orders;
    }

    private function getSaleResult($time1, $time2)
    {
        $orders = $orders = Order::where('created_at', '>=', $time1)->where('created_at', '<=', $time2)
            ->where('status', '已付款')->get();
        return $orders;
    }
}
