<?php

namespace App\Http\Middleware;

use Closure;
use Jleon\LaravelPnotify\Notify;

class CacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Cache::has('早餐') || !\Cache::has('午餐') || !\Cache::has('晚餐')){
            Notify::error('请先更新早午晚餐项，在进行该操作');
            return back();
        }
        return $next($request);
    }
}
