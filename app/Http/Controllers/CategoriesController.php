<?php

namespace App\Http\Controllers;

use App\Models\AttributeSet;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    public function show($category_id)
    {
        $category = Category::find($category_id);
        if ($category->child_count > 0) {
            return view('category.show', compact('category'));
        }

        return redirect()->route('products.show.category', [$category_id]);
    }

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

        $categoryAttributeSetsID = $category->attributeSets; // Получаем массив идентификаторов категорий товара
        $categoryAttributeSetsID = $category->attributeSets->pluck('id')->toArray(); // Получаем массив идентификаторов категорий товара
        $attributeSets = AttributeSet::all()->except($categoryAttributeSetsID);

        return view('admin.categories.edit', compact('categories', 'category', 'attributeSets'));
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

    public function attachattributeset(Request $request, int $id)
    {
        $category = Category::query()->findOrFail($id);
        $validated = $request->validate([
            'attribute_set' => ['required', 'exists:attribute_sets,id'],
        ]);
        $category->attributeSets()->attach($validated['attribute_set']);
        return redirect()->back()->with(['message' => __('You successfully attach attribute set')]);
    }

    public function detachattributeset(Request $request, int $id)
    {
        $category = Category::query()->findOrFail($id);
        $validated = $request->validate([
            'attribute_set' => ['required', 'exists:attribute_sets,id'],
        ]);
        $category->attributeSets()->detach($validated['attribute_set']);
        return redirect()->back()->with(['message' => __('You successfully detach attribute set')]);
    }
}
