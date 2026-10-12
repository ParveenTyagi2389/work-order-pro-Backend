<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartRequest;
use App\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartController extends Controller
{
    public function index(Request $request): View
    {
        $parts = Part::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));

                $query->where(function ($where) use ($term) {
                    $where->where('part_number', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%");
                });
            })
            ->orderBy('part_number')
            ->paginate(10)
            ->withQueryString();

        return view('backend.parts.index', compact('parts'));
    }

    public function create(): View
    {
        return view('backend.parts.create');
    }

    public function store(PartRequest $request): RedirectResponse
    {
        $part = Part::create($request->validated());

        return redirect()->route('parts.show', $part)
            ->with('success', 'Part created successfully.');
    }

    public function show(Part $part): View
    {
        return view('backend.parts.show', compact('part'));
    }

    public function edit(Part $part): View
    {
        return view('backend.parts.edit', compact('part'));
    }

    public function update(PartRequest $request, Part $part): RedirectResponse
    {
        $part->update($request->validated());

        return redirect()->route('parts.show', $part)
            ->with('success', 'Part updated successfully.');
    }

    public function destroy(Part $part): RedirectResponse
    {
        $part->delete();

        return redirect()->route('parts.index')
            ->with('success', 'Part deleted successfully.');
    }
}
