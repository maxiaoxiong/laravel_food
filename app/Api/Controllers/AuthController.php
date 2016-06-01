<?php
/**
 * Created by PhpStorm.
 * User: xiongzai
 * Date: 5/3/16
 * Time: 11:09 PM
 */
namespace App\Api\Controllers;

use App\Api\Components\VerifyCode;
use App\Mobile;
use App\User;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use PhpSms;

class AuthController extends BaseController
{
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt(['phone' => $request->get('phone'), 'password' => $request->get('password')])) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getVerifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:11'
        ]);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('手机号的长度不对.', $validator->errors());
        }
        $Code = VerifyCode::generate_code(4);
        Cache::put($request->get('phone'), $Code, 5);
        $newMobile = [
            'mobile' => $request->get('phone')
        ];
        $mobile = Mobile::firstOrCreate($newMobile);
        if (!($mobile->id)) {
            return response()->json(['status_code' => 401, 'message' => '报错了，请联系管理员！']);
        }
        $data = PhpSms::make()->to($request->get('phone'))->content('【小胖带饭】您的验证码是 ' . $Code . '')->send();
        if ($data['logs'][0]['result']['code'] == 0) {
            return response()->json(['status_code' => 200, 'message' => '发送成功，有效时间为五分钟，请尽快验证']);
        } elseif ($data['logs'][0]['result']['code'] == 22) {
            return response()->json(['status_code' => 429, 'message' => '一小时内只能发送三次验证码，请一小时后重新发送']);
        } else {
            return response()->json(['status_code' => 401, 'message' => '报错了，请联系管理员！']);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        $mobile = Mobile::where('mobile', $request->get('phone'))->get();
        if (count($mobile) == 0) {
            return response()->json(['status_code' => 200, 'message' => '用户未创建，请先创建验证您的手机号']);
        }
        if ($mobile[0]->is_verified == 0) {
            return response()->json(['status_code' => 200, 'message' => '您的手机号未通过验证，请先验证手机号']);
        }
        $data = [
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'password' => bcrypt($request->get('password'))
        ];
        $status = User::firstOrCreate($data);
        if ($status) {
            return response()->json(['status_code' => 200, 'message' => '用户创建成功，请登录！']);
        }

        return response()->json(['status_code' => 422, 'message' => '用户创建未成功！请重新尝试！']);
    }

    public function validateCode(Request $request)
    {
        $phoneNumber = $request->get('phone');
        if (Cache::get($phoneNumber) == $request->get('verifyCode')) {
            $Mobile = Mobile::where('mobile', $phoneNumber)->update(['is_verified' => 1]);
            if ($Mobile) {
                return response()->json(['status_code' => 200, 'message' => '验证成功']);
            }
        } else {
            return response()->json(['status_code' => 401, 'message' => '验证码错误，请重新输入']);
        }
    }

    public function getAuthenticatedUser()
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

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }
}