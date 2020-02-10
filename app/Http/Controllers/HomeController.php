<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Sample;

class HomeController extends Controller
{
    use Sample;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        $menu = $this->printThis()['menu'];
        $notification = $this->printThis()['data'];
        return view('dashboard', compact('menu','notification'));
    }
}
