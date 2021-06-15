<?php

namespace App\Http\Controllers;

use App\Bill;
use App\User;
use App\Order;
use App\Driver;
use App\Market;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $search_order = null;
        if($request->order_id){
            $search_order = Order::where('order_number', $request->order_id)->first();
        }

        $new = Order::where('status', Order::ORDER_DEFAULT)->count();
        $accepted = Order::where('status', Order::ORDER_ACCEPTED)->count();
        $run = Order::whereIn('status', [Order::ORDER_IN_ROAD , Order::ORDER_IN_SHIPPING])->count();
        $done = Order::where('status', Order::ORDER_DONE)->count();
        $users  = User::where('company_id', null)->count();
        $companies = Company::count();
        return view('dashboard.index', compact('new', 'accepted', 'run', 'done', 'users', 'companies'));
    }
}
