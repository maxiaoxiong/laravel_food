<?php

namespace App\Http\Middleware;

use App\Time;
use Carbon\Carbon;
use Closure;

class TimeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $noon_time = Time::where('name', '午餐')->get();
        $after_time = Time::where('name', '晚餐')->get();
        if ((Carbon::now()->hour . ':' . Carbon::now()->minute . ":00") >= $noon_time->over_time && (Carbon::now()->hour . ':' . Carbon::now()->minute . ":00") <= $after_time->time) {
            return response()->json(['status_code' => 200, 'message' => '该时间段内不能订餐！']);
        }
        return $next($request);
    }
}
