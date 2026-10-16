<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobBillableRequest;
use App\Models\JobBillable;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class JobBillableController extends Controller
{
    public function index(Request $request): View
    {
        $jobBillables = JobBillable::with('workOrder')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = trim((string) $request->input('search'));
                $query->where(function ($sub) use ($term) {
                    $sub->where('description', 'like', "%{$term}%")
                        ->orWhereHas('workOrder', fn ($w) => $w->where('customer_work_order', 'like', "%{$term}%"));
                });
            })->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.job_billables.index', compact('jobBillables'));
    }
    public function create(): View
    {
         return view('backend.job_billables.create', ['workOrders' => WorkOrder::orderByDesc('id')->get()]);
    }
    public function store(JobBillableRequest $request): RedirectResponse 
    {
        $item = JobBillable::create($request->validated());
        return redirect()->route('job-billables.show', $item)->with('success', 'Job billing record created successfully.');
    }
    public function show(JobBillable $job_billable): View
    {
        $job_billable->load('workOrder');
        return view('backend.job_billables.show', ['jobBillable' => $job_billable]);
    }
    public function edit(JobBillable $job_billable): View
    {
        return view('backend.job_billables.edit', ['jobBillable' => $job_billable, 'workOrders' => WorkOrder::orderByDesc('id')->get()]);
    }
    public function update(JobBillableRequest $request, JobBillable $job_billable): RedirectResponse
    {
        $job_billable->update($request->validated());
        return redirect()->route('job-billables.show', $job_billable)->with('success', 'Job billing record updated successfully.');
    }
    public function destroy(JobBillable $job_billable): RedirectResponse 
    {
        $job_billable->delete();
        return redirect()->route('job-billables.index')->with('success', 'Job billing record deleted successfully.');
    }
}
