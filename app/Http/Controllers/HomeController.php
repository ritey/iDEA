<?php

namespace App\Http\Controllers;

use Idea\Traits\Key;
use Idea\Traits\Shrink;
use Illuminate\Http\Request;
use Idea\Libraries\BadgeLibrary;
use Illuminate\Contracts\Cache\Factory as Cache;

class HomeController extends Controller
{
    use Key, Shrink;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, BadgeLibrary $badges, Cache $cache)
    {
        $this->badges = $badges;
        $this->request = $request;
        $this->cache = $cache->store('frontend_views');
        $this->middleware('auth')->except(['index','about']);
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = 1;
        if ($this->request->get('page')) {
            $page = $this->request->get('page');
        }
        $key = $this->key(basename($this->request->url()) . '_page_' . $page);
		if ($this->cache->has($key) && config('app.coderstudios.cache_enabled')) {
			$view = $this->cache->get($key);
		} else {
            $vars = [
                'most_popular_citizen' => $this->badges->enabled()->where('category_id',1)->orderBy('complete_count','DESC')->take(3)->get(),
            ];
            $view = view('index',compact('vars'))->render();
			$this->cache->add($key, $view, config('cache.cache_duration'));
        }
        return $view;
    }

    public function about()
    {
        /* 
            3.8kb with shrink function
            4.0kb without shrink function
            based on 1348 visible characters on the about page
        */
        return $this->shrink(view('about'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }
}
