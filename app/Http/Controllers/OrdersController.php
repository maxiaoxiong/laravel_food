<?php

namespace App\Http\Controllers;

use App\Api\Components\ExcelExport;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Excel;

class OrdersController extends Controller
{
    /**
     * @param Request $request
     */
    public function handleOrder(Request $request)
    {
//        \Pingpp\Pingpp::setApiKey(env('API_KEY'));
//
//        $charge = \Pingpp\Charge::create(
//            array(
//                'order_no' => time().rand(1000,9999),
//                'amount'   => '10000',
//                'app'      => ['id'=>env('APP_C_KEY')],
//                'channel'  => 'alipay',
//                'currency' => 'cny',
//                'client_ip' => $request->ip(),
//                'subject'  => 'pay success',
//                'body'     => 'pay OK!',
////                'extra'    => ['success_url'=>'http://ping.app/charge/paid']
//            )
//        );
//
//        return view('orders.charge',compact('charge'));
        dd('ss');
    }

    /**
     * @param $type
     */
    public function printOrders($type)
    {
        switch ($type) {
            case 1:
                $orders = Order::where('created_at', '>=', Carbon::today())->get();
                break;
            case 2:
                $orders = Order::where('created_at', '>=', Carbon::createFromDate()->startOfWeek())->get();
                break;
            case 3:
                $orders = Order::all();
                break;
        }

        ExcelExport::export($orders);
    }

    /**
     *
     */
    public function overOrder()
    {
        dd('sss');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTodayOrders()
    {
        $orders = Order::where('created_at', '>=', Carbon::today())->paginate(10);

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
}
