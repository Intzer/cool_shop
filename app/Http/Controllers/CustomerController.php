<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function delete(Request $request, int $id)
    {
        $customer = Customer::query()->findOrFail($id);
        $customer->delete();
        return redirect()->back()->with(['message' => __('Successfully deleted')]);
    }

    public function edit(Request $request, int $id)
    {
        $customer = Customer::query()->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:1'],
            'balance' => ['required', 'decimal:0,2'],
        ]);

        $customer = Customer::query()->findOrFail($id);
        $customer->update([
            'name' => $validated['name'],
            'balance' => $validated['balance'],
        ]);

        return redirect()->back()->with(['message' => __('Successfully updated')]);
    }
}
