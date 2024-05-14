<?php

namespace App\Http\Controllers;

use App\Models\AttributeTemplate;
use Illuminate\Http\Request;

class AttributeTemplatesController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1', 'alpha_dash'],
        ]);

        $attributeTemplate = new AttributeTemplate([
            'name' => $validated['name'],
        ]);
        $attributeTemplate->save();
        return redirect()->back()->with(['message' => 'successfully created']);
    }


    public function edit(Request $request, int $id)
    {
        $attributeTemplate = AttributeTemplate::query()->findOrFail($id);
        return view('admin.attributeTemplates.edit', compact('attributeTemplate'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1', 'alpha_dash'],
        ]);

        $attributeTemplate = AttributeTemplate::query()->findOrFail($id);
        $attributeTemplate->update([
            'name' => $validated['name'],
        ]);

        return redirect()->back()->with(['message' => __('Updated successfully')]);
    }

    public function delete(Request $request, int $id)
    {
        $attributeTemplate = AttributeTemplate::query()->findOrFail($id);
        $attributeTemplate->delete();
        return redirect()->back()->with(['message' => __('Deleted successfully')]);
    }
}
