<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\AttributeTemplate;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index');
    }

    public function categories()
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function products()
    {
        $products = Product::query()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function customers()
    {
        $customers = Customer::query()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function attributeSets()
    {
        $attributeSets = AttributeSet::query()->paginate(10);
        $attributeTemplates = AttributeTemplate::all();
        return view('admin.attributeSets.index', compact('attributeSets', 'attributeTemplates'));
    }

    public function attributeTemplates()
    {
        $attributeTemplates = AttributeTemplate::query()->paginate(10);
        return view('admin.attributeTemplates.index', compact('attributeTemplates'));
    }
}
