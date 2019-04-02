<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     * Logs are visible only if user is logged in
     * @return Renderable
     */
    public function index()
    {
        $logs = '';
        if (Auth::check()) {
            $logs = Auth::user()->logs->all();
        }
        return view('home')->with('logs', $logs);
    }
}
