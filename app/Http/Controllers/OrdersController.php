<?php

namespace App\Http\Controllers;

use App\Components\ExcelExport;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;
use Pingpp\Charge;
use Pingpp\Pingpp;

class OrdersController extends Controller
{

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
                'order_no'  => time().rand(1000,99999),
                'amount'    => '100',
                'app'       => array('id' => env('PING_APP_ID')),
                'channel'   => 'alipay',
                'currency'  => 'cny',
                'client_ip' => $request->ip(),
                'subject'   => 'Xicode_demo',
                'body'      => '1',
//                'extra'     => ['extern_token']
            )
        );
        return $charge;
        return view('orders.charge',compact('charge'));
    }




    /**
     * @param $type
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function printOrders($type)
    {
        $lastDayTime = Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            '18', '30', '00');
        $todayMorningTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '07', '00', '00');
        $todayNoonTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '11', '30', '00');
        $todayAfterTime = Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '17', '30', '00');
        $timeNow = Carbon::now();
        switch ($type) {
            case 1:
                if ($timeNow >= $lastDayTime && $timeNow <= $todayMorningTime) {
                    $orders = $this->getPrintResult($lastDayTime, $todayMorningTime);
                } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
                    $orders = $this->getPrintResult($todayMorningTime, $todayNoonTime);
                } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
                    $orders = $this->getPrintResult($todayNoonTime, $todayAfterTime);
                }
                ExcelExport::exportWindowDetail($orders);
                break;
            case 2:
                if ($timeNow >= $lastDayTime && $timeNow <= $todayMorningTime) {
                    $tags = $this->getTagsResult($lastDayTime, $todayMorningTime);
                } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
                    $tags = $this->getTagsResult($todayMorningTime, $todayNoonTime);
                } elseif ($timeNow >= $todayNoonTime && $timeNow < Carbon::tomorrow()) {
                    $tags = $this->getTagsResult($todayNoonTime, $todayAfterTime);
                }
                ExcelExport::exportTags($tags);
                break;
            case 3:
                if ($timeNow >= $lastDayTime && $timeNow <= $todayMorningTime) {
                    $orders = $this->getDormitoryResult($lastDayTime, $todayMorningTime);
                } elseif ($timeNow >= $todayMorningTime && $timeNow <= $todayNoonTime) {
                    $orders = $this->getDormitoryResult($todayMorningTime, $todayNoonTime);
                } elseif ($timeNow >= $todayNoonTime && $timeNow <= $todayAfterTime) {
                    $orders = $this->getDormitoryResult($todayNoonTime, $todayAfterTime);
                }
                ExcelExport::exportDormitoryDetail($orders);
        }

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTodayOrders()
    {
        $orders = Order::where('created_at', '<=', Carbon::create(Carbon::today()->year, Carbon::today()->month, Carbon::today()->day,
            '18', '30', '00'))->where('created_at', '>=', Carbon::create(Carbon::yesterday()->year, Carbon::yesterday()->month, Carbon::yesterday()->day,
            '18', '30', '00'))->paginate(10);

        return view('orders.today', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWeekOrders()
    {
        $orders = Order::where('created_at', '>=', Carbon::createFromDate()->startOfWeek())->paginate(10);

        return view('orders.week', compact('orders'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHistoryOrders()
    {
        $orders = Order::paginate(10);

        return view('orders.history', compact('orders'));
    }

    /**
     * @param $time1
     * @param $time2
     * @return array
     */
    public function getPrintResult($time1, $time2)
    {
        $orders = \DB::select('SELECT canteen_name,window_name,dish_name,order_no FROM ( SELECT canteen_id,dish_name,order_no,window_name FROM (SELECT dish_name,order_no,window_id FROM (SELECT dish_id,sum(order_no) AS order_no FROM orders WHERE created_at >= "' . $time1 . '" AND created_at <= "' . $time2 . '" GROUP BY dish_id) AS i,dishes AS d WHERE i.dish_id = d.id) AS s,windows AS w WHERE s.window_id = w.id) AS i2, canteens
WHERE i2.canteen_id = canteens.id');

        return $orders;
    }

    public function getTagsResult($time1, $time2)
    {
        $tags = \DB::select('SELECT
  d2.dish_name,
  order_no,
  d2.dish_price,
  user_name,
  user_phone,
  b.building_name,
  f.floor_name,
  d.name AS dormitory_name,
  d2.window_id,
  msg
FROM orders AS o, dishes AS d2, dormitories AS d, floors AS f, buildings AS b,windows AS w,canteens as c
WHERE o.dormitory_id = d.id AND d.floor_id = f.id AND f.building_id = b.id AND o.dish_id = d2.id AND
      d2.window_id = w.id AND w.canteen_id = c.id AND o.created_at >= "'.$time1.'" AND o.created_at <= "'.$time2.'"');

        return $tags;
    }

    public function getDormitoryResult($time1, $time2)
    {
        $orders = \DB::select('SELECT d2.dish_name,order_no,
  user_name,
  user_phone,b.building_name,f.floor_name,d.name AS dormitory_name FROM orders AS o , dishes AS d2 , dormitories AS d, floors AS f, buildings AS b WHERE o.dormitory_id = d.id AND d.floor_id = f.id AND f.building_id = b.id AND o.dish_id = d2.id AND o.created_at >= "'.$time1.'" AND o.created_at <= "'.$time2.'"');

        return $orders;
    }
}
