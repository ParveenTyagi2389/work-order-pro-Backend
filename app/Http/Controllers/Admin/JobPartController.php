<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPartRequest;
use App\Models\JobPart;
use App\Models\Part;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class JobPartController extends Controller
{
    public function index(Request $request): View
    {
        $jobParts = JobPart::with(['workOrder', 'part'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));
                $query->where(function ($sub) use ($term) {
                    $sub->whereHas('part', fn ($p) => $p->where('part_number', 'like', "%{$term}%"))
                        ->orWhereHas('workOrder', fn ($w) => $w->where('customer_work_order', 'like', "%{$term}%"));
                });
            })
            ->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.job_parts.index', compact('jobParts'));
    }
    public function create(): View { return view('backend.job_parts.create', $this->options()); }
    public function store(JobPartRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['ordered'] = $request->boolean('ordered');
        $item = JobPart::create($data);
        return redirect()->route('job-parts.show', $item)->with('success', 'Job part created successfully.');
    }
    public function show(JobPart $job_part): View
    {
        $job_part->load(['workOrder', 'part']);
        return view('backend.job_parts.show', ['jobPart' => $job_part]);
    }
    public function edit(JobPart $job_part): View
    {
        return view('backend.job_parts.edit', array_merge(['jobPart' => $job_part], $this->options()));
    }
    public function update(JobPartRequest $request, JobPart $job_part): RedirectResponse
    {
        $data = $request->validated();
        $data['ordered'] = $request->boolean('ordered');
        $job_part->update($data);
        return redirect()->route('job-parts.show', $job_part)->with('success', 'Job part updated successfully.');
    }
    public function destroy(JobPart $job_part): RedirectResponse
    {
        $job_part->delete();
        return redirect()->route('job-parts.index')->with('success', 'Job part deleted successfully.');
    }
    private function options(): array
    {
        return ['workOrders' => WorkOrder::orderByDesc('id')->get(), 'parts' => Part::orderBy('part_number')->get()];
    }
}
