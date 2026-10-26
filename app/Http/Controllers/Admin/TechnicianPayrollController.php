<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\TechnicianPayrollRequest;
use App\Models\Technician;
use App\Models\TechnicianPayroll;
use Illuminate\Http\Request;
class TechnicianPayrollController extends Controller {
    public function index(Request $request)
    { 
        $payrolls=TechnicianPayroll::with('technician')
        ->when($request->filled('search'),function($q)use($request){
            $s=trim((string)$request->search);
            $q->where(function($w)use($s){
                $w->where('tech_payroll_uid','like',"%$s%")
                ->orWhere('notes','like',"%$s%")
                ->orWhereHas('technician',fn($t)=>$t->where('name','like',"%$s%"));
            });
        })->when($request->filled('paid'),
        fn($q)=>$q->where('paid',$request->boolean('paid')))
        ->orderByDesc('time_in_out')->paginate(10)->withQueryString();
        return view('backend.technician_payroll.index',compact('payrolls')); 
    }
    public function create()
    {
        return view('backend.technician_payroll.create',['technicians'=>Technician::orderBy('name')->get()]);
    }
    public function store(TechnicianPayrollRequest $request)
    {
        $data=$request->validated();
        foreach(['authorized','paid','paid_check'] as $f)
        {
            $data[$f]=$request->boolean($f);
        }
        $p=TechnicianPayroll::create($data);
        return redirect()->route('technician-payroll.show',$p)->with('success','Payroll record created.');
    }
    public function show(TechnicianPayroll $technician_payroll)
    {
        $technician_payroll->load('technician');
        return view('backend.technician_payroll.show',['payroll'=>$technician_payroll]);
    }
    public function edit(TechnicianPayroll $technician_payroll)
    {
        return view('backend.technician_payroll.edit',['payroll'=>$technician_payroll,'technicians'=>Technician::orderBy('name')->get()]);
    }
    public function update(TechnicianPayrollRequest $request,TechnicianPayroll $technician_payroll)
    {
        $data=$request->validated();
        foreach(['authorized','paid','paid_check'] as $f)
        {
            $data[$f]=$request->boolean($f);
        }
        $technician_payroll->update($data);
        return redirect()->route('technician-payroll.show',$technician_payroll)->with('success','Payroll record updated.');
    }
    public function destroy(TechnicianPayroll $technician_payroll)
    {
        $technician_payroll->delete();
        return redirect()->route('technician-payroll.index')->with('success','Payroll record deleted.');
    }
}
