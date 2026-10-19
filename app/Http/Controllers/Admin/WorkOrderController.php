<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorkOrderRequest;
use App\Models\JobCode;
use App\Models\Site;
use App\Models\Technician;
use App\Models\WorkOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class WorkOrderController extends Controller {
    public function index(Request $request): View {
        $workOrders = WorkOrder::with(['site','technician','jobCode'])
            ->when($request->filled('search'), function($q) use ($request) {
                $term = trim((string)$request->input('search'));
                $q->where(function($sub) use ($term) {
                    $sub->where('customer_work_order','like',"%{$term}%")
                        ->orWhere('problem','like',"%{$term}%");
                });
            })
            ->when($request->filled('status'), function($q) use ($request) {
                match ($request->input('status')) {
                    'serviced' => $q->where('serviced',1),
                    'not_serviced' => $q->where('serviced',0),
                    'billed' => $q->where('billed',1),
                    'not_billed' => $q->where('billed',0),
                    default => $q,
                };
            })
            ->orderByDesc('job_created_at')->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.work_orders.index', compact('workOrders'));
    }
    public function create(): View { return view('backend.work_orders.create', $this->formOptions()); }
    public function store(WorkOrderRequest $request): RedirectResponse {
        $data = $request->validated();
        foreach (['fuel_reimbursement','serviced','billed'] as $flag) $data[$flag] = $request->boolean($flag);
        $workOrder = WorkOrder::create($data);
        return redirect()->route('work-orders.show',$workOrder)->with('success','Work order created successfully.');
    }
    public function show(WorkOrder $work_order): View {
        $work_order->load(['site','technician','jobCode']);
        return view('backend.work_orders.show',['workOrder'=>$work_order]);
    }
    public function edit(WorkOrder $work_order): View {
        return view('backend.work_orders.edit', array_merge(['workOrder'=>$work_order],$this->formOptions()));
    }
    public function update(WorkOrderRequest $request, WorkOrder $work_order): RedirectResponse {
        $data = $request->validated();
        foreach (['fuel_reimbursement','serviced','billed'] as $flag) $data[$flag] = $request->boolean($flag);
        $work_order->update($data);
        return redirect()->route('work-orders.show',$work_order)->with('success','Work order updated successfully.');
    }
    public function destroy(WorkOrder $work_order): RedirectResponse {
        $work_order->delete();
        return redirect()->route('work-orders.index')->with('success','Work order deleted successfully.');
    }
    private function formOptions(): array {
        return [
            'sites'=>Site::orderBy('name')->get(),
            'technicians'=>Technician::orderBy('name')->get(),
            'jobCodes'=>JobCode::orderBy('foldername')->get(),
        ];
    }
}
