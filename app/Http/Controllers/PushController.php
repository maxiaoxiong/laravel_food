<?php


namespace App\Http\Controllers;


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
        $result = $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert($request->get('content'))
            ->send();

        //这里要加上判断逻辑，判断请求是否成功！
        if (isset($result->errcode)) {
            return view('push.new', ['code' => 400, 'msg' => $result->errmsg]);
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
        $payload = $client->push()
            ->setPlatform("all")
            ->addAllAudience()
            ->setNotificationAlert($request->get('content'))
            ->build();

        $response = $client->schedule()->createSingleSchedule("每天14点发送的定时任务", $payload, array("time" => $request->get('time')));

        /**
         * 如何获取一个api调用后的http状态码？？？
         */
        $json_response = json_decode($response);
        if (!isset($json_response->schedule_id)) {
            return view('push.new', ['code' => 400, 'msg' => $json_response->error->message]);
        }

        $push_timing = new PushTimely;
        $push_timing->schedule_id = $json_response->schedule_id;
        $push_timing->name = $json_response->name;
        $push_timing->content = $request->get('content');
        $push_timing->time = $request->get('time');
        $push_timing->save();

        return view('push.history', ['code' => 200, 'msg' => '新建推送成功']);
    }
}