<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteRequest;
use App\Models\BillTo;
use App\Models\CustomerType;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sites = Site::with(['customerType', 'billTo'])
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = $request->string('q');
                $q->where(function ($w) use ($term) {
                    $w->where('name', 'like', "%{$term}%")
                      ->orWhere('site_id', 'like', "%{$term}%")
                      ->orWhere('city', 'like', "%{$term}%")
                      ->orWhere('state', 'like', "%{$term}%")
                      ->orWhere('zip', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('cust_type_id'), fn ($q) =>
                $q->where('cust_type_id', $request->cust_type_id))
            ->orderBy('name')
            ->paginate(25)
            ->withQueryString();

        $customerTypes = CustomerType::orderBy('name')->get();

        return view('backend.site.index', compact('sites', 'customerTypes'));
    }

    public function create()
    {
        return view('backend.site.create', $this->formData());
    }

    public function store(SiteRequest $request)
    {
        $site = Site::create($request->validated());

        return redirect()
            ->route('sites.show', $site)
            ->with('success', 'Site created successfully.');
    }

    public function show(Site $site)
    {
        $site->load(['customerType', 'billTo', 'jobs', 'storePictures']);

        return view('backend.site.show', compact('site'));
    }

    public function edit(Site $site)
    {
        return view('backend.site.edit', array_merge(
            $this->formData(),
            ['site' => $site]
        ));
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->validated());

        return redirect()
            ->route('sites.show', $site)
            ->with('success', 'Site updated successfully.');
    }

    public function destroy(Site $site)
    {
        $site->delete();

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site deleted successfully.');
    }

    private function formData(): array
    {
        return [
            'customerTypes' => CustomerType::orderBy('name')->get(),
            'billTos'       => BillTo::orderBy('bill_name')->get(),
        ];
    }
}
