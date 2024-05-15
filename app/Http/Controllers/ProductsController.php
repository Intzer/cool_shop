<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\File;

class ProductsController extends Controller
{
    public function inCategory(Category $category)
    {

    }

    public function index()
    {
        $categories = Category::query()->whereNull('parent_id')->get();
        $products = Product::all();

        $category_id = request()->get('category');
        if (isset($category_id))
        {
            $products = $products->filter(function ($product) use ($category_id) {
                return $product->categories->isNotEmpty() && $product->categories->contains('id', $category_id);
            });
        }

        return view('products', compact('products', 'categories'));
    }

    public function show(int $id)
    {
        $product = Product::query()->findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'alpha_dash'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:10000'],
            'description' => ['required', 'string', 'max:100000'],
            'url' => ['required', 'string', 'min:1', 'max:256'],
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
            'image' => $image,
            'url' => $validated['url'],
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
        $productCategoriesID = $product->categories->pluck('id')->toArray(); // Получаем массив идентификаторов категорий товара
        $categories = Category::all()->except($productCategoriesID);

        $attributeSets = new Collection();
        foreach ($product->categories as $category)
        {
            $attributeSet = $category->attributeSets;
            if ($attributeSet->isNotEmpty()) {
                $attributeSets = $attributeSets->merge($attributeSet);
            }
        }
        $attributeSets = $attributeSets->unique('id');
        $attributes = Attribute::query()->where('product_id', $id)->get();


        return view('admin.products.edit', compact('product', 'categories', 'attributeSets', 'attributes'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:3', 'alpha_dash'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:10000'],
            'description' => ['required', 'string', 'max:100000'],
            'category_id' => ['required', 'exists:categories,id'],
            'url' => ['required', 'string', 'min:1', 'max:256'],
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
            'url' => $validated['url'],
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

    public function tocategory(Request $request, int $id)
    {
        $product = Product::query()->findOrFail($id);
        $validated = $request->validate([
            'category' => ['required', 'exists:categories,id'],
        ]);
        $product->categories()->attach($validated['category']);
        return redirect()->back()->with(['message' => __('You successfully attach category')]);
    }

    public function fromcategory(Request $request, int $id)
    {
        $product = Product::query()->findOrFail($id);
        $validated = $request->validate([
            'category' => ['required', 'exists:categories,id'],
        ]);
        $product->categories()->detach($validated['category']);
        return redirect()->back()->with(['message' => __('You successfully detach category')]);
    }

    public function buy(Request $request, int $id)
    {
        $product = Product::query()->findOrFail($id);
        $customer = Customer::query()->findOrFail(auth()->user()->id);
        if ($customer->orders->contains('id', $product->id)) {
            return redirect()->back()->with(['message' => 'You are already own this stuff, check orders page.']);
        }

        if ($customer->balance >= $product->price->price)
        {
            $customer->balance -= $product->price->price;
            $customer->save();

            $order = new Order([
                'product_id' => $product->id,
                'customer_id' => $customer->id,
            ]);
            $order->save();

            return redirect()->route('orders.index')->with(['message', __('Enjoy your new purchase.')]);
        }

        return redirect()->back()->withErrors(['message' => __('You do not have enough money.')]);
    }

    public function fillattributes()
    {
        return redirect()->back()->with(['message' => 'Not emplemented yet.']);
    }
}
