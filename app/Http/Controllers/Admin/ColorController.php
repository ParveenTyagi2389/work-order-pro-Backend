<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ColorController extends Controller
{
    public function index(Request $request): View
    {
        $colors = Color::query()
            ->when($request->filled('search'), fn($q) => $q->where('color_name','like','%'.trim((string)$request->input('search')).'%'))
            ->orderBy('color_name')->paginate(10)->withQueryString();
        return view('backend.colors.index',compact('colors'));
    }
    public function create(): View { return view('backend.colors.create'); }
    public function store(ColorRequest $request): RedirectResponse
    {
        Color::create($request->validated());
        return redirect()->route('colors.index')->with('success','Color created successfully.');
    }
    public function show(Color $color): View { return view('backend.colors.show',compact('color')); }
    public function edit(Color $color): View { return view('backend.colors.edit',compact('color')); }
    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $color->update($request->validated());
        return redirect()->route('colors.index')->with('success','Color updated successfully.');
    }
    public function destroy(Color $color): RedirectResponse
    {
        if (\App\Models\JobCode::where('foldercolor',$color->color_name)->exists()) {
            return redirect()->route('colors.index')->with('error','This color is used by a job code and cannot be deleted.');
        }
        $color->delete();
        return redirect()->route('colors.index')->with('success','Color deleted successfully.');
    }
}
