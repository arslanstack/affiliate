<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\UserCommission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index(){
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function details($order_number){
        $order = Order::where('order_number', $order_number)->with('items')->first();
        $commissions = UserCommission::where('order_id', $order->id)->get();
        return view('admin.orders.details', compact('order', 'commissions'));
    }
}
