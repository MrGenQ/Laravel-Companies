<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['showOrders']]);
    }
    public function addOrders(Request $request) {
        Orders::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product
        ]);

        return view('/pages.dashboard');
    }
    public function showOrders(){
        $orders = Orders::all();
        return view('pages.show-orders', compact('orders'));
    }
    public function deleteOrder(Orders $orders){
        $orders->delete();
        return redirect('/show-orders');
    }
}
