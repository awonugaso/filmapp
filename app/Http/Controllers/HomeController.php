<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
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
        $total = Transaction::where('status', 'approve');
        $total_last_month = Transaction::whereMonth(
            'created_at', '=', Carbon::now()->subMonth()->month
        )->where('status', 'approve')->sum('cost');
        return view('home', ['total_purchase' => $total->count(), 'last_month' => $total_last_month]);
    }
}
