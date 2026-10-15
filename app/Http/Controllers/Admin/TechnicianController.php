<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicianRequest;
use App\Models\Technician;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class TechnicianController extends Controller
{
    public function index(Request $request): View
    {
        $technicians = Technician::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));
                $query->where(function ($where) use ($term) {
                    $where->where('name', 'like', "%{$term}%")
                        ->orWhere('email', 'like', "%{$term}%")
                        ->orWhere('phone', 'like', "%{$term}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                if ($request->input('status') === 'active') $query->where('active', 1);
                elseif ($request->input('status') === 'inactive') $query->where('active', 0);
            })
            ->orderBy('name')->paginate(10)->withQueryString();
        return view('backend.technicians.index', compact('technicians'));
    }
    public function create(): View
    {
         return view('backend.technicians.create');
    }
    public function store(TechnicianRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['active'] = $request->boolean('active');
        $technician = Technician::create($data);
        return redirect()->route('technicians.show', $technician)->with('success', 'Technician created successfully.');
    }
    public function show(Technician $technician): View 
    {
        return view('backend.technicians.show', compact('technician'));
    }
    public function edit(Technician $technician): View 
    {
        return view('backend.technicians.edit', compact('technician')); 
    }
    public function update(TechnicianRequest $request, Technician $technician): RedirectResponse
    {
        $data = $request->validated();
        $data['active'] = $request->boolean('active');
        $technician->update($data);
        return redirect()->route('technicians.show', $technician)->with('success', 'Technician updated successfully.');
    }
    public function destroy(Technician $technician): RedirectResponse
    {
        $technician->delete();
        return redirect()->route('technicians.index')->with('success', 'Technician deleted successfully.');
    }
}
