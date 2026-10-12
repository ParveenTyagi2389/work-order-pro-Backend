<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobCodeRequest;
use App\Models\JobCode;
use App\Models\Color;
use App\Models\Shape;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobCodeController extends Controller
{
    public function index(Request $request): View
    {
        $jobCodes = JobCode::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = trim((string)$request->input('search'));
                $q->where('foldername','like',"%{$term}%")
                  ->orWhere('foldercolor','like',"%{$term}%")
                  ->orWhere('foldershape','like',"%{$term}%");
            })
            ->orderBy('foldername')->paginate(10)->withQueryString();

        return view('backend.job_codes.index', compact('jobCodes'));
    }

    public function create(): View
    {
        return view('backend.job_codes.create', [
            'colors' => Color::orderBy('color_name')->get(),
            'shapes' => Shape::orderBy('shape_name')->get(),
        ]);
    }

    public function store(JobCodeRequest $request): RedirectResponse
    {
        $jobCode = JobCode::create($request->validated());
        return redirect()->route('job-codes.index')->with('success','Job code created successfully.');
    }

    public function show(JobCode $job_code): View
    {
        return view('backend.job_codes.show', ['jobCode'=>$job_code]);
    }

    public function edit(JobCode $job_code): View
    {
        return view('backend.job_codes.edit', [
            'jobCode'=>$job_code,
            'colors'=>Color::orderBy('color_name')->get(),
            'shapes'=>Shape::orderBy('shape_name')->get(),
        ]);
    }

    public function update(JobCodeRequest $request, JobCode $job_code): RedirectResponse
    {
        $job_code->update($request->validated());
        return redirect()->route('job-codes.index')->with('success','Job code updated successfully.');
    }

    public function destroy(JobCode $job_code): RedirectResponse
    {
        $job_code->delete();
        return redirect()->route('job-codes.index')->with('success','Job code deleted successfully.');
    }
}
