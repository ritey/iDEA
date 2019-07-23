<?php

namespace App\Http\Controllers;

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
    public function __construct()
    {
        $this->middleware('auth')->except(['index','about']);
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
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
