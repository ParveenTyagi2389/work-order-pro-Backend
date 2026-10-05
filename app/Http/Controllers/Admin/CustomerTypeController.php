<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function index(Request $request)
    {
        $customerTypes = CustomerType::query()
            ->withCount('sites')
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = $request->string('q');
                $q->where('name', 'like', "%{$term}%");
            })
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('customer-types.index', compact('customerTypes'));
    }

    public function create()
    {
        return view('customer-types.create');
    }

    public function store(CustomerTypeRequest $request)
    {
        CustomerType::create($request->validated());

        return redirect()
            ->route('customer-types.index')
            ->with('success', 'Customer type created successfully.');
    }

    public function show(CustomerType $customerType)
    {
        $customerType->loadCount('sites');
        $customerType->load(['sites' => fn ($q) => $q->orderBy('name')->limit(50)]);

        return view('customer-types.show', compact('customerType'));
    }

    public function edit(CustomerType $customerType)
    {
        return view('customer-types.edit', compact('customerType'));
    }

    public function update(CustomerTypeRequest $request, CustomerType $customerType)
    {
        $customerType->update($request->validated());

        return redirect()
            ->route('customer-types.index')
            ->with('success', 'Customer type updated successfully.');
    }

    public function destroy(CustomerType $customerType)
    {
        // Prevent delete if sites are still attached
        if ($customerType->sites()->exists()) {
            return redirect()
                ->route('customer-types.index')
                ->with('error', 'Cannot delete: sites are assigned to this customer type.');
        }

        $customerType->delete();

        return redirect()
            ->route('customer-types.index')
            ->with('success', 'Customer type deleted successfully.');
    }
}
