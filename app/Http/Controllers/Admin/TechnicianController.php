<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use App\Models\workOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TechnicianController extends Controller
{
    public function index(Request $request): View
    {
        $query = Technician::query()
            ->withCount([
                'jobs as jobs_mtd' => function ($q) {
                    $q->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                },
            ])
            ->with([
                'jobs' => function ($q) {
                    $q->latest('created_at')->limit(1);
                }
            ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($search = trim((string) $request->input('search'))) {

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Active / Inactive Filter
        |--------------------------------------------------------------------------
        |
        | Your database has `active`, NOT `status`.
        |
        */

        if ($request->filled('status')) {

            if ($request->status === 'Active') {
                $query->where('active', true);
            }

            if ($request->status === 'Inactive') {
                $query->where('active', false);
            }
        }

        $technicians = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalTeam = Technician::count();

        $activeTeam = Technician::where('active', true)->count();

        $inactiveTeam = Technician::where('active', false)->count();

        $jobsToday = workOrder::whereDate('created_at', today())->count();

        $jobsThisMonth = workOrder::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return view('backend.technicians.index', compact(
            'technicians',
            'totalTeam',
            'activeTeam',
            'inactiveTeam',
            'jobsToday',
            'jobsThisMonth'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        return view('backend.technicians.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $data['name'] = trim($data['name']);

        $data['active'] = $request->boolean('active');

        $technician = Technician::create($data);

        return redirect()
            ->route('technicians.show', $technician)
            ->with('success', 'Technician created successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Technician $technician): View
    {
        $technician->load([
            'jobs' => function ($q) {
                $q->latest('created_at')->limit(10);
            }
        ]);

        return view('backend.technicians.show', compact('technician'));
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Technician $technician): View
    {
        return view('backend.technicians.edit', compact('technician'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Technician $technician
    ): RedirectResponse {

        $data = $this->validated($request);

        $data['name'] = trim($data['name']);

        $data['active'] = $request->boolean('active');

        $technician->update($data);

        return redirect()
            ->route('technicians.show', $technician)
            ->with('success', 'Technician updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function destroy(Technician $technician): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Don't delete technician if jobs exist
        |--------------------------------------------------------------------------
        */

        if ($technician->jobs()->exists()) {

            return redirect()
                ->route('technicians.index')
                ->with(
                    'error',
                    'This technician has work orders and cannot be deleted. Set the technician to inactive instead.'
                );
        }

        $technician->delete();

        return redirect()
            ->route('technicians.index')
            ->with('success', 'Technician deleted successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */

    public function export()
    {
        $technicians = Technician::query()
            ->orderBy('name')
            ->get();

        $filename = 'technicians-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($technicians) {

            $out = fopen('php://output', 'w');

            fputcsv($out, [
                'ID',
                'Access',
                'Name',
                'Phone',
                'Email',
                'Notes',
                'Active',
                'Created At',
                'Updated At',
            ]);

            foreach ($technicians as $technician) {

                fputcsv($out, [
                    $technician->id,
                    $technician->access,
                    $technician->name,
                    $technician->phone,
                    $technician->email,
                    $technician->notes,
                    $technician->active ? 'Yes' : 'No',
                    $technician->created_at,
                    $technician->updated_at,
                ]);
            }

            fclose($out);

        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8'
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

    private function validated(Request $request): array
    {
        return $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30'
            ],

            'email' => [
                'nullable',
                'email',
                'max:255'
            ],

            'notes' => [
                'nullable',
                'string'
            ],

            'access' => [
                'nullable',
                'integer'
            ],

            'active' => [
                'nullable',
                'boolean'
            ],

        ]);
    }
}

