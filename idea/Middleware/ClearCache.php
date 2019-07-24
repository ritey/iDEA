<?php

namespace Idea\Middleware;

use Closure;
use Illuminate\Contracts\Cache\Repository as Cache;

class ClearCache
{
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     * @return void
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     */
    public function handle($request, Closure $next)
    {
        if (config('app.env') != 'testing' && (!config('app.idea.cache_enabled') || $request->session()->get('clear_cache'))) {
            $this->cache->flush();
            $request->session()->remove('clear_cache');
        }

        return $next($request);
    }
}