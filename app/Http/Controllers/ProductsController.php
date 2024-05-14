<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductPrice;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'alpha_dash'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:10000'],
            'description' => ['required', 'string', 'max:100000'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product = new Product();
        $product->save();

        $productInfo = new ProductInfo([
            'product_id' => $product->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
        ]);
        $productInfo->save();

        $productPrice = new ProductPrice([
           'product_id' => $product->id,
           'price' => $validated['price'],
        ]);
        $productPrice->save();

        return redirect()->back()->with(['message' => __('Successfully created')]);
    }

    public function edit(Request $request, int $id)
    {
        $product = Product::query()->findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function delete(Request $request, int $id)
    {

    }
}
