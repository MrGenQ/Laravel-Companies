<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['showCompanies']]);
    }
    public function addProduct(){
        $companies = Company::pluck('company')->toArray();
        return view('pages.add-product', compact('companies'));
    }
    public function createProduct(Request $request, Company $company) {
        $validated = $request->validate([
            'product' => 'required',
            'barcode' => 'required',
            'price' => 'required',
            'company' => 'required'
        ]);
        Product::create([
            'product' => $request->product,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'company' => $request->company

        ]);

        return redirect('/');
    }
    public function showProducts(){
        $products = Product::all();
        return view('pages.show-products', compact('products'));
    }
    public function showOrders(){
        //
    }

}
