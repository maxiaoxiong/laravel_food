<?php


namespace App\Http\Controllers;

use APIRequestException;
use App\PushTimely;
use App\PushTiming;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;

class PushController extends Controller
{
    public function index()
    {
        $push_timely_count = PushTimely::all();
        $push_timing_count = PushTiming::all();

        return view('push.history', ['timelys' => $push_timely_count, 'timings' => $push_timing_count]);
    }

    public function add(Request $request)
    {
        return view('push.add');
    }

    public function timely(Request $request)
    {
        //收集数据
        /**
         *  及时推送表  msgid content
         */
        $client = new \JPush(env('PUSH_APP_KEY'), env('PUSH_MASTER_SECRET'));

        try {
            $result = $client->push()
                ->setPlatform('all')
                ->addAllAudience()
                ->setNotificationAlert($request->get('content'))
                ->send();
        } catch (APIRequestException $e) {
            \Log::error(time() . ' 推送失败，http状态码为：' . $e->httpCode . '，错误代码为：' . $e->code . ' ，信息为：' . $e->message);
            Flash::error('推送失败，错误信息为' . $e->message . '，请联系管理员。');
            return view('push.new', ['code' => $e->httpCode, 'msg' => '服务器内部错误，请联系开发人员。']);
        }

        //msgid , content , sendno

        $push_timely = new PushTimely;
        $push_timely->msg_id = $result->data->msg_id;
        $push_timely->sendno = $result->data->sendno;
        $push_timely->content = $request->get('content');
        $push_timely->save();

        Flash::success('推送成功');
        return redirect('/push/history');
    }

    public function timing(Request $request)
    {
        /**
         *  定时推送表 msgid content time
         */
        $client = new \JPush(env('PUSH_APP_KEY'), env('PUSH_MASTER_SECRET'));

        try {
            $payload = $client->push()
                ->setPlatform("all")
                ->addAllAudience()
                ->setNotificationAlert($request->get('content'))
                ->build();

            $response = $client->schedule()->createSingleSchedule("每天14点发送的定时任务", $payload, array("time" => $request->get('time')));

        } catch (APIRequestException $e) {
            \Log::error(time() . ' 定时任务创建失败，http状态码为： ' . $e->httpCode . '，错误代码为：' . $e->code . '，错误信息为：' . $e->message);
            Flash::error('创建定时任务失败，错误信息为： ' . $e->message . '，请联系管理员');
            return view('push.add', ['code' => $e->code, 'msg' => $e->message]);
        }

        /**
         * 如何获取一个api调用后的http状态码？？？
         */
        

        $push_timing = new PushTiming();
        $push_timing->schedule_id = $response->data->schedule_id;
        $push_timing->name = $response->data->name;
        $push_timing->content = $request->get('content');
        $push_timing->time = $request->get('time');
        $push_timing->save();
        Flash::success('定时任务创建成功');
        return redirect('/push/history');
    }
}