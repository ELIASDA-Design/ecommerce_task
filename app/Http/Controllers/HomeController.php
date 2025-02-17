<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show() {
        $products = Product::all();
        return view('welcome', compact('products'));
    }
}
