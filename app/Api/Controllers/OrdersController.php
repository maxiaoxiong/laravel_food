<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/3/16
 * Time: 10:54 PM
 */

namespace App\Api\Controllers;


use App\Api\Transformers\OrderTransformer;
use App\Order;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use JWTAuth;
use Redis;

class OrdersController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        $orders = Order::where('user_id', $user->id)->get();

        return $this->response->item($orders, new OrderTransformer())->setStatusCode(200);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        if (!$id) {
            return $this->response->errorNotFound('Order not found');
        }

        return $this->response->item($order, new OrderTransformer())->setStatusCode(200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->get('data');
        foreach ($data as $k => $v) {
            $order = Order::Create(array_merge($data[ $k ]));
            if (!$order) {
                throw new StoreResourceFailedException('创建订单失败！');
            }
            $order->tastes()->attach($data[ $k ]['taste_id']);
            $order->tablewares()->attach($data[ $k ]['tableware_id']);
        }
        $ordersToday = Order::where('created_at', '>=', Carbon::today())->count();
        $data = [
            'event' => 'ordersToday',
            'data' => [
                'num' => $ordersToday
            ]
        ];
        Redis::publish('test-channel', json_encode($data));

        return response()->json(['status_code' => 200, 'message' => '创建订单成功！']);

    }

    /**
     * @param Request $request
     * @return Charge
     */
//    client->server(pay)->server->aliply->server(get Charge Object)->return Charge to client
//    ->valid true -> server(save to database)
    public function payTest(Request $request){
        \Pingpp\Pingpp::setApiKey(env('PING_API_KEY'));
        \Pingpp\Pingpp::setPrivateKeyPath(base_path('RSACret/rsa_private_key.pem'));

        $ch = \Pingpp\Charge::create(
            array(
                'order_no'  => time().rand(1000,99999),
                'app'       => array('id' => env('PING_APP_ID')),
                'channel'   => 'alipay',
                'amount'    => 1,
                'client_ip' => $request->ip(),
                'currency'  => 'cny',
                'subject'   => '杏花村',
                'body'      => '马啸雄'.' 正在购买 '.'杏花村',
                'extra'     => array()
            )
        );

        return $ch;
    }
    public function pay(Request $request){

        \Pingpp\Pingpp::setApiKey(env('PING_API_KEY'));
        \Pingpp\Pingpp::setPrivateKeyPath(base_path('RSACret/rsa_private_key.pem'));

        $dish_id = $request->get('dish_id');
        $dish_name = $request->get('dish_name');

        $ch = \Pingpp\Charge::create(
            array(
                'order_no'  => $dish_id,
                'app'       => array('id' => env('PING_APP_ID')),
                'channel'   => $request->get('channel'),
                'amount'    => $request->get('amount'),
                'client_ip' => $request->ip(),
                'currency'  => 'cny',
                'subject'   => $dish_id,
                'body'      => $request->get('user_name').' 正在购买 '.$dish_name,
                'extra'     => array()
            )
        );

        return $ch;
    }
    
}