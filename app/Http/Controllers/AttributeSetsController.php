<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\AttributeTemplate;
use Illuminate\Http\Request;

class AttributeSetsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'alpha_dash'],
            'template' => ['required', 'exists:attribute_templates,id'],
        ]);

        $attributeSet = new AttributeSet([
           'name' => $validated['name'],
           'attribute_template_id' => $validated['template'],
        ]);
        $attributeSet->save();

        return redirect()->back()->with(['message' => __('Successfully created')]);
    }

    public function edit(Request $request, int $id)
    {
        $attributeSet = AttributeSet::query()->findOrFail($id);
        $attributeTemplates = AttributeTemplate::all();
        return view('admin.attributeSets.edit', compact('attributeSet', 'attributeTemplates'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'alpha_dash'],
            'template' => ['required', 'exists:attribute_templates,id'],
        ]);

        $attributeSet = AttributeSet::query()->findOrFail($id);
        $attributeSet->update([
           'name' => $validated['name'],
           'attribute_template_id' => $validated['template'],
        ]);

        return redirect()->back()->with(['message' => __('Updated successfully')]);
    }

    public function delete(Request $request, int $id)
    {
        $attributeSet = AttributeSet::query()->findOrFail($id);
        $attributeSet->delete();
        return redirect()->back()->with(['message' => __('Deleted successfully')]);
    }
}
