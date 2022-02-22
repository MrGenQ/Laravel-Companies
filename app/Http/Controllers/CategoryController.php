<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Company;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['showCompanies']]);
    }
    public function addCategory(){
        return view('pages.add-category');
    }
    public function createCategory(Request $request) {
        $validated = $request->validate([
            'category' => 'required'
        ]);
        Category::create([
            'category' => $request->category
        ]);

        return redirect('/');
    }
    public function showCompanies(Request $request) {
        $categories = Category::all();

        $companies = [];
        if(request('category')) {
            $companies = Company::where('category_id', request('category'))->get();
        }

        return view('pages.show-categories', compact('categories', 'companies'));
    }
}
