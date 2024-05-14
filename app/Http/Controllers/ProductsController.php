<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products', compact('products'));
    }

    public function show($product_id)
    {
        $product = Product::find($product_id);

        return view('product/show', compact('product'));
    }

    public function store(Request $request)
    {

    }

    public function delete(Request $request, int $id)
    {

    }
}
