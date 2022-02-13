<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Orders;

class OrderController extends Controller
{
    public function addOrders(Product $product) {

        Orders::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);

        return view('/');
    }
}
