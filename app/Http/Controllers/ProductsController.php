<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductInfo;
use App\Models\ProductPrice;

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

    public function delete(Request $request, int $id)
    {

    }
}
