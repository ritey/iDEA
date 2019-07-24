<?php

namespace App\Http\Controllers;

use Idea\Models\Badges;
use Idea\Traits\Shrink;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Shrink;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Badges $badges)
    {
        $this->badges = $badges;
        $this->middleware('auth')->except(['index','about']);
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vars = [
            'most_popular_citizen' => $this->badges->enabled()->where('category_id',1)->orderBy('complete_count','DESC')->take(3)->get(),
        ];
        return view('index',compact('vars'));
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
