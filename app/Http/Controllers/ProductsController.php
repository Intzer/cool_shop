<?php

namespace App\Http\Controllers;

use App\Models\Product;
use http\Env\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function store(Request $request)
    {

    }
}
