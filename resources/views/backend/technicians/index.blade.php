@extends('layouts.master')
@section('title','WorkOrder Pro - Technicians')
@section('header-title','Technicians')
@section('content')
<div class="mb-large"><h2 class="page-title-custom mb-small">Technicians</h2></div>
<div class="row margin-btm-lg">
 <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
        <div class="tech-stat-card">

            <div class="tech-stat-label">
                TOTAL TEAM
            </div>

            <div class="tech-stat-value">
                {{ $totalTeam }}
            </div>

            <div class="tech-stat-subtext-green text-gray-light">
                All technicians
            </div>

        </div>
    </div>


    <!-- ACTIVE TEAM -->
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
        <div class="tech-stat-card">

            <div class="tech-stat-label text-success-dark">
                ACTIVE TEAM
            </div>

            <div class="tech-stat-value">
                {{ $activeTeam }}
            </div>

            <div class="tech-stat-subtext-green text-gray-light">
                Currently active
            </div>

        </div>
    </div>


    <!-- INACTIVE TEAM -->
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
        <div class="tech-stat-card">

            <div class="tech-stat-label">
                INACTIVE TEAM
            </div>

            <div class="tech-stat-value">
                {{ $inactiveTeam }}
            </div>

            <div class="tech-stat-subtext-green text-gray-light">
                Currently inactive
            </div>

        </div>
    </div>


    <!-- JOBS TODAY -->
    <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
        <div class="tech-stat-card">

            <div class="tech-stat-label">
                JOBS TODAY
            </div>

            <div class="tech-stat-value">
                {{ $jobsToday }}
            </div>

            <div class="tech-stat-subtext-green text-gray-light">
                {{ $jobsThisMonth }} jobs this month
            </div>

        </div>
    </div>
</div>
<form method="GET" action="{{ route('technicians.index') }}" class="panel border mb-large-padded">
  <div class="filter-bar-row mb-zero"><div class="filter-bar-left"><div class="filter-bar-search"><input name="search" value="{{ request('search') }}" class="form-control-custom filter-search-input" placeholder="Search technicians..." type="text" /><i class="fi-rs-search filter-search-icon"></i></div></div>
  <div class="filter-bar-right">
    <select name="status" class="select-filter-custom"><option>All Statuses</option>@foreach(['Active','On Site','En Route','Scheduled','Overdue','Inactive'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ $status }}</option>@endforeach</select>
    {{-- <select name="zone" class="select-filter-custom"><option>All Zones</option>@foreach($zones as $zone)<option value="{{ $zone }}" @selected(request('zone')===$zone)>{{ $zone }}</option>@endforeach</select> --}}
    {{-- <select name="skill" class="select-filter-custom"><option>All Skills</option>@foreach($skills as $skill)<option value="{{ $skill }}" @selected(request('skill')===$skill)>{{ $skill }}</option>@endforeach</select> --}}
    <button class="btn-export-custom" type="submit"><i class="fi-rs-search"></i> Filter</button>
    <a class="btn-export-custom text-decoration-none" href="{{ route('technicians.export') }}"><i class="fi-rs-download"></i> Export</a>
    <a class="btn-custom btn-primary-custom font-weight-bold text-decoration-none" href="{{ route('technicians.create') }}">+ Add Technician</a>
  </div></div>
</form>
<div class="panel"><div class="table-responsive-custom border panel-rounded-border"><table class="table-custom"><thead><tr><th class="font-weight-bold text-gray-light">TECHNICIAN</th><th class="font-weight-bold text-gray-light">STATUS</th><th class="font-weight-bold text-gray-light">CURRENT JOB</th><th class="font-weight-bold text-gray-light">ZONE</th><th class="font-weight-bold text-gray-light">SKILLS</th><th class="font-weight-bold text-gray-light">JOBS (MTD)</th><th class="font-weight-bold text-gray-light">RATING</th><th class="font-weight-bold text-gray-light">ACTIONS</th></tr></thead>
<tbody>
@forelse($technicians as $technician)
<tr><td><div class="tech-table-avatar-cell"><div class="tech-table-avatar tech-avatar-green">{{ $technician->initials }}<div class="status-dot {{ $technician->active ? 'dot-green' : 'dot-red' }}"></div></div><div><div class="tech-table-name">{{ $technician->name }}</div><div class="tech-table-sub">{{ $technician->role ?: 'Technician' }}</div></div></div></td>
<td><span class="{{ $technician->status === 'On Site' ? 'badge-cert-green font-semibold' : ($technician->status === 'Overdue' ? 'badge-status-danger' : 'badge-status-info') }}">{{ $technician->status }}</span></td>
<td><span class="tech-wo-green">{{ optional($technician->jobs->first())->id ? 'WO-'.str_pad($technician->jobs->first()->id,4,'0',STR_PAD_LEFT) : '—' }}</span><span class="tech-wo-desc">{{ optional(optional($technician->jobs->first())->jobCode)->name ? '-- '.optional($technician->jobs->first()->jobCode)->name : '' }}</span></td>
<td class="text-gray-dark">{{ $technician->primary_zone ?: '—' }}</td><td>@foreach(($technician->skills ?? []) as $skill)<span class="badge-cert-blue">{{ $skill }}</span> @endforeach</td><td class="font-weight-bold text-gray-darkest">{{ $technician->jobs_mtd }}</td>
<td><div class="tech-stars-row"><i class="fi-sr-star star-color"></i><i class="fi-sr-star star-color"></i><i class="fi-sr-star star-color"></i><i class="fi-sr-star star-color"></i><i class="fi-sr-star-sharp-half star-color"></i><span class="text-gray-light-sm-bold">{{ number_format($technician->rating,1) }}</span></div></td>
<td><div class="action-btns-row"><a class="btn-action-simple text-decoration-none" href="{{ route('technicians.edit',$technician) }}">Edit</a><a class="btn-action-simple text-decoration-none" href="{{ route('technicians.show',$technician) }}">Profile</a><form method="POST" action="{{ route('technicians.destroy',$technician) }}" onsubmit="return confirm('Delete this technician?');" style="display:inline">@csrf @method('DELETE')<button class="btn-action-simple" type="submit">Delete</button></form></div></td></tr>
@empty<tr><td colspan="8" class="text-center p-4">No technicians found.</td></tr>@endforelse
</tbody></table></div></div>
<div class="mt-3">{{ $technicians->links() }}</div>
@endsection
