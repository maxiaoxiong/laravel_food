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
        if (!\Cache::has(2) || !\Cache::has(4) || !\Cache::has(6)){
            Notify::error('请先更新早午晚餐项，在进行该操作');
            return back();
        }
        return $next($request);
    }
}
