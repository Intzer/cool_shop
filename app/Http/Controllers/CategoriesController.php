<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1', 'unique:categories'],
            'parent' => ['nullable'],
        ]);

        $parentCategory = null;
        if ($validated['parent'] != -1) {
            $parentCategory = Category::query()->findOrFail($validated['parent']);
        }

        $category = new Category([
            'name' => $validated['name'],
            'parent_id' => $parentCategory ? $validated['parent'] : null,
        ]);
        $category->save();

        if ($parentCategory) {
            $parentCategory->child_count += 1;
            $parentCategory->save();
        }

        return redirect()->back()->with(['message' => 'Category was created']);
    }
}
