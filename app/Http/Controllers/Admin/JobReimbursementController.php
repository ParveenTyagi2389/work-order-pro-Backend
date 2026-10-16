<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobReimbursementRequest;
use App\Models\JobReimbursement;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
class JobReimbursementController extends Controller {
    public function index(Request $request)
    { 
        $jobReimbursements=JobReimbursement::with('workOrder')->when($request->filled('search'),function($q)use($request)
        {
            $t=trim((string)$request->input('search'));
            $q->where(function($s)use($t)
            {
                $s->where('description','like',"%$t%")
                ->orWhere('amount','like',"%$t%")
                ->orWhereHas('workOrder',fn($w)=>$w->where('customer_work_order','like',"%$t%"));
            });
        })->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.job_reimbursements.index',compact('jobReimbursements'));
    }
    public function create() 
    {
        return view('backend.job_reimbursements.create',['workOrders'=>WorkOrder::orderByDesc('id')->get()]);
    }
    public function store(JobReimbursementRequest $request) 
    {
        $item=JobReimbursement::create($request->validated());
        return redirect()->route('job-reimbursements.show',$item)->with('success','Reimbursement created successfully.');
    }
    public function show(JobReimbursement $job_reimbursement)
    {
        $job_reimbursement->load('workOrder');
        return view('backend.job_reimbursements.show',['jobItem'=>$job_reimbursement]);
    }
    public function edit(JobReimbursement $job_reimbursement)
    {
        return view('backend.job_reimbursements.edit',['jobReimbursement'=>$job_reimbursement,'workOrders'=>WorkOrder::orderByDesc('id')->get()]);
    }
    public function update(JobReimbursementRequest $request,JobReimbursement $job_reimbursement) 
    {
        $job_reimbursement->update($request->validated());
        return redirect()->route('job-reimbursements.show',$job_reimbursement)->with('success','Reimbursement updated successfully.');
    }
    public function destroy(JobReimbursement $job_reimbursement) 
    {
        $job_reimbursement->delete();
        return redirect()->route('job-reimbursements.index')->with('success','Reimbursement deleted successfully.');
    }
}
