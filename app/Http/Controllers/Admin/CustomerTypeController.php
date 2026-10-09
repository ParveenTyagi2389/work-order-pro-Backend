<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerTypeRequest;
use App\Models\CustomerType;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerTypeController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $customerTypes = CustomerType::query()
            ->withCount('sites')
            ->when($search !== '', fn ($query) =>
                $query->where('name', 'like', "%{$search}%")
            )
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        $totalTypes = CustomerType::count();
        $typesInUse = CustomerType::has('sites')->count();
        $newThisMonth = CustomerType::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        return view('backend.customer.index', compact(
            'customerTypes',
            'search',
            'totalTypes',
            'typesInUse',
            'newThisMonth'
        ));
    }

    public function create(): View
    {
        return view('backend.customer.create');
    }

    public function store(CustomerTypeRequest $request): RedirectResponse
    {
        $customerType = CustomerType::create($request->validated());

        return redirect()
            ->route('customer-types.show', $customerType)
            ->with('success', 'Customer type created successfully.');
    }

    public function show(CustomerType $customerType): View
    {
        $customerType->loadCount('sites');
        $customerType->load([
            'sites' => fn ($query) => $query->orderBy('name'),
        ]);

        return view('backend.customer.show', compact('customerType'));
    }

    public function edit(CustomerType $customerType): View
    {
        $customerType->loadCount('sites');

        return view('backend.customer.edit', compact('customerType'));
    }

    public function update(CustomerTypeRequest $request, CustomerType $customerType): RedirectResponse
    {
        $customerType->update($request->validated());

        return redirect()
            ->route('customer-types.show', $customerType)
            ->with('success', 'Customer type updated successfully.');
    }

    public function destroy(CustomerType $customerType): RedirectResponse
    {
        if ($customerType->sites()->exists()) {
            return back()->with('error',
                'This customer type cannot be deleted because it is assigned to one or more sites.'
            );
        }

        try {
            $customerType->delete();
        } catch (QueryException $e) {
            return back()->with('error',
                'This customer type cannot be deleted because it is referenced by existing records.'
            );
        }

        return redirect()
            ->route('customer-types.index')
            ->with('success', 'Customer type deleted successfully.');
    }
}
