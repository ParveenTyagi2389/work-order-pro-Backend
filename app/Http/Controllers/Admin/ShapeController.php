<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ShapeRequest;
use App\Models\Shape;
use App\Models\JobCode;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ShapeController extends Controller
{
    public function index(Request $request): View
    {
        $shapes = Shape::query()
            ->when($request->filled('search'), fn($q) => $q->where('shape_name','like','%'.trim((string)$request->input('search')).'%'))
            ->orderBy('shape_name')->paginate(10)->withQueryString();
        return view('backend.shapes.index',compact('shapes'));
    }
    public function create(): View 
    {
        return view('backend.shapes.create');
    }
    public function store(ShapeRequest $request): RedirectResponse
    {
        Shape::create($request->validated());
        return redirect()->route('shapes.index')->with('success','Shape created successfully.');
    }
    public function show(Shape $shape): View
    {
        return view('backend.shapes.show',compact('shape')); 
    }
    public function edit(Shape $shape): View 
    {
        return view('backend.shapes.edit',compact('shape')); 
    }
    public function update(ShapeRequest $request, Shape $shape): RedirectResponse
    {
        $shape->update($request->validated());
        return redirect()->route('shapes.index')->with('success','Shape updated successfully.');
    }
    public function destroy(Shape $shape): RedirectResponse
    {
        if (JobCode::where('foldershape',$shape->shape_name)->exists()) {
            return redirect()->route('shapes.index')->with('error','This shape is used by a job code and cannot be deleted.');
        }
        $shape->delete();
        return redirect()->route('shapes.index')->with('success','Shape deleted successfully.');
    }
}
