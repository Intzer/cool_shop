<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1'],
            'parent' => ['required'],
        ]);

        $newParentCategory = null;
        if ($validated['parent'] != -1) {
            $newParentCategory = Category::query()->findOrFail($validated['parent']);
        }

        $category = new Category([
            'name' => $validated['name'],
            'parent_id' => $newParentCategory ? $validated['parent'] : null,
        ]);
        $category->save();

        if ($newParentCategory) {
            $newParentCategory->update(['child_count' => $newParentCategory->child_count + 1]);
        }

        return redirect()->back()->with(['message' => __('Category was created')]);
    }

    public function delete(Request $request, int $id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return redirect()->back()->with(['message' => __('Successfully deleted')]);
    }

    public function edit(Request $request, int $id)
    {
        $categories = Category::all();
        $category = Category::query()->findOrFail($id);
        return view('category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1'],
            'parent' => ['required'],
        ]);

        $category = Category::query()->findOrFail($id);
        $lastParentCategory = null;
        if ($category->parent_id != -1) {
            $lastParentCategory = Category::query()->find($category->parent_id);
        }

        $newParentCategory = null;
        if ($validated['parent'] != -1)
        {
            $newParentCategory = Category::query()->find($validated['parent']);

            if ($newParentCategory->id == $id) {
                return redirect()->back()->withInput()->withErrors(['message' => __('You can not make loop parent.')]);
            }
        }

        $category->update([
            'name' => $validated['name'],
            'parent_id' => $newParentCategory ? $validated['parent'] : null,
        ]);

        if ($lastParentCategory) {
            $lastParentCategory->update(['child_count' => $lastParentCategory->child_count - 1]);
        }

        if ($newParentCategory) {
            $newParentCategory->update(['child_count' => $newParentCategory->child_count + 1]);
        }

        return redirect()->back()->with(['message' => __('Successfully updated')]);
    }
}
