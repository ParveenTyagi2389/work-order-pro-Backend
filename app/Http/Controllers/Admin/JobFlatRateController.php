<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobFlatRateRequest;
use App\Models\JobFlatRate;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
class JobFlatRateController extends Controller {
 public function index(Request $request) { $jobFlatRates=JobFlatRate::with('workOrder')->when($request->filled('search'),function($q)use($request){$t=trim((string)$request->input('search'));$q->where(function($s)use($t){$s->where('description','like',"%$t%")->orWhere('rate','like',"%$t%")->orWhereHas('workOrder',fn($w)=>$w->where('customer_work_order','like',"%$t%"));});})->orderByDesc('id')->paginate(10)->withQueryString();return view('backend.job_flat_rates.index',compact('jobFlatRates')); }
 public function create() { return view('backend.job_flat_rates.create',['workOrders'=>WorkOrder::orderByDesc('id')->get()]); }
 public function store(JobFlatRateRequest $request) { $item=JobFlatRate::create($request->validated());return redirect()->route('job-flat-rates.show',$item)->with('success','Flat rate created successfully.');}
 public function show(JobFlatRate $job_flat_rate) { $job_flat_rate->load('workOrder');return view('backend.job_flat_rates.show',['jobItem'=>$job_flat_rate]);}
 public function edit(JobFlatRate $job_flat_rate) {return view('backend.job_flat_rates.edit',['jobFlatRate'=>$job_flat_rate,'workOrders'=>WorkOrder::orderByDesc('id')->get()]);}
 public function update(JobFlatRateRequest $request,JobFlatRate $job_flat_rate) {$job_flat_rate->update($request->validated());return redirect()->route('job-flat-rates.show',$job_flat_rate)->with('success','Flat rate updated successfully.');}
 public function destroy(JobFlatRate $job_flat_rate) {$job_flat_rate->delete();return redirect()->route('job-flat-rates.index')->with('success','Flat rate deleted successfully.');}
}
