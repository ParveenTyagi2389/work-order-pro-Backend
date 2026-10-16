<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobPictureRequest;
use App\Models\JobPicture;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class JobPictureController extends Controller {
    public function index(Request $request) {
        $jobPictures = JobPicture::with('workOrder')
            ->when($request->filled('search'), function($q) use ($request) {
                $term = trim((string)$request->input('search'));
                $q->where(function($sub) use ($term) {
                    $sub->where('description','like',"%{$term}%")
                        ->orWhereHas('workOrder',fn($wo) => $wo->where('customer_work_order','like',"%{$term}%"));
                });
            })->orderByDesc('id')->paginate(10)->withQueryString();
        return view('backend.job_pictures.index', compact('jobPictures'));
    }
    public function create() {
        return view('backend.job_pictures.create',['workOrders'=>WorkOrder::orderByDesc('id')->get()]);
    }
    public function store(JobPictureRequest $request) {
        $data = $request->validated();
        $data['picture'] = $request->file('picture')->store('job-pictures','public');
        $item = JobPicture::create($data);
        return redirect()->route('job-pictures.show',$item)->with('success','Job picture uploaded successfully.');
    }
    public function show(JobPicture $job_picture) {
        $job_picture->load('workOrder');
        return view('backend.job_pictures.show',['item'=>$job_picture]);
    }
    public function edit(JobPicture $job_picture) {
        return view('backend.job_pictures.edit',['jobPicture'=>$job_picture,'workOrders'=>WorkOrder::orderByDesc('id')->get()]);
    }
    public function update(JobPictureRequest $request, JobPicture $job_picture) {
        $data = $request->validated();
        if ($request->hasFile('picture')) {
            if ($job_picture->picture) Storage::disk('public')->delete($job_picture->picture);
            $data['picture'] = $request->file('picture')->store('job-pictures','public');
        } else unset($data['picture']);
        $job_picture->update($data);
        return redirect()->route('job-pictures.show',$job_picture)->with('success','Job picture updated successfully.');
    }
    public function destroy(JobPicture $job_picture) {
        if ($job_picture->picture) Storage::disk('public')->delete($job_picture->picture);
        $job_picture->delete();
        return redirect()->route('job-pictures.index')->with('success','Job picture deleted successfully.');
    }
}
