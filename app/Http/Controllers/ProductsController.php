<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function show($product_id)
    {
        $product = Product::query()->find($product_id);
        return view('product/show', compact('product'));
    }

    public function showCategory($category_id)
    {
        $products = DB::select(
            'WITH RECURSIVE all_categories(id) AS (
                SELECT id
                FROM categories
                WHERE id = ?
                UNION ALL
                SELECT c.id
                FROM categories c
                INNER JOIN all_categories ac ON c.parent_id = ac.id
            )

            SELECT DISTINCT p.*
            FROM products p
            INNER JOIN category_product mcp ON p.id = mcp.product_id
            WHERE mcp.category_id IN (SELECT id FROM all_categories);',
            [$category_id]
        );

        return view('products', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'alpha_dash'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:10000'],
            'description' => ['required', 'string', 'max:100000'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png', 'gif'])
                    ->min(1)
                    ->max(10000)
            ],
        ]);

        $image = null;
        if (isset($validated['image']))
        {
            $file = $request->file('image');
            if (!$file) {
                return redirect()->back()->withErrors(['image' => __('Error of loading image.')]);
            }
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->storeAs('public', 'files/images/' . $fileName);
            $image = $fileName;
        }

        $product = new Product();
        $product->save();

        $productInfo = new ProductInfo([
            'product_id' => $product->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'image' => $image,
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

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'alpha_dash'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:10000'],
            'description' => ['required', 'string', 'max:100000'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => [
                'nullable',
                File::types(['jpg', 'jpeg', 'png', 'gif'])
                    ->min(1)
                    ->max(10000)
            ],
        ]);

        $product = Product::query()->findOrFail($id);
        $productInfo = ProductInfo::query()->where('product_id', $id)->firstOrFail();
        $productPrice = ProductPrice::query()->where('product_id', $id)->firstOrFail();

        $image = null;
        if (isset($validated['image']))
        {
            $file = $request->file('image');
            if (!$file) {
                return redirect()->back()->withErrors(['image' => __('Error of loading image.')]);
            }
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->storeAs('public', 'files/images/' . $fileName);
            $image = $fileName;
        }

        $productInfo->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'image' => $image,
        ]);
        $productPrice->update([
           'price' => $validated['price'],
        ]);

        return redirect()->back()->with(['message' => __('Updated successfully')]);
    }

    public function delete(Request $request, int $id)
    {
        $product = Product::query()->findOrFail($id);
        $product->delete();
        return redirect()->back()->with(['message' => __('Deleted successfully')]);
    }
}
