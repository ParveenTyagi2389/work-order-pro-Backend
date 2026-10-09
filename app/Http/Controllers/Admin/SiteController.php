<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest;
use App\Models\BillTo;
use App\Models\CustomerType;
use App\Models\Site;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function index(Request $request): View
    {
        $sites = Site::with(['customerType', 'billTo'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $term = trim((string) $request->input('q'));

                $query->where(function ($where) use ($term) {
                    $where->where('name', 'like', "%{$term}%")
                        ->orWhere('site_id', 'like', "%{$term}%")
                        ->orWhere('address', 'like', "%{$term}%")
                        ->orWhere('city', 'like', "%{$term}%")
                        ->orWhere('state', 'like', "%{$term}%")
                        ->orWhere('zip', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('customer_type'), fn ($query) =>
                $query->where('customer_type', $request->input('customer_type')))
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        return view('backend.site.index', [
            'sites' => $sites,
            'customerTypes' => CustomerType::orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return view('backend.site.create', $this->formData());
    }

    public function store(SiteRequest $request): RedirectResponse
    {
        $site = Site::create($request->validated());

        return redirect()->route('sites.show', $site)
            ->with('success', 'Site created successfully.');
    }

    public function show(Site $site): View
    {
        $site->load(['customerType', 'billTo']);

        return view('backend.site.show', compact('site'));
    }

    public function edit(Site $site): View
    {
        return view('backend.site.edit', array_merge($this->formData(), ['site' => $site]));
    }

    public function update(SiteRequest $request, Site $site): RedirectResponse
    {
        $site->update($request->validated());

        return redirect()->route('sites.show', $site)
            ->with('success', 'Site updated successfully.');
    }

    public function destroy(Site $site): RedirectResponse
    {
        $site->delete();

        return redirect()->route('sites.index')
            ->with('success', 'Site deleted successfully.');
    }

    private function formData(): array
    {
        return [
            'customerTypes' => CustomerType::orderBy('name')->get(),
            'billTos' => BillTo::orderBy('bill_name')->get(),
        ];
    }
}
