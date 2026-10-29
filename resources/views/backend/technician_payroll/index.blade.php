@extends('layouts.master')
@section('topbar-title','Technician Payroll')
@section('page-title','WorkOrder Pro - Technician Payroll')
@section('content')
<div class="content-area">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <h2 class="page-title font-weight-bold mb-4">
        Technician Payroll
    </h2>
    <div class="search-action-row">
        <form method="GET" action="{{ route('technician-payroll.index') }}" class="search-input-width search-box-max-width">
            <input name="search" value="{{ request('search') }}" placeholder="Search , technician or notes" class="form-control-custom custom-search-padding search-icon-wrapper-input-custom">
            <select name="paid" class="form-control-custom">
                <option value="">
                    All payment statuses
                </option>
                <option value="1" @selected(request('paid')==='1')>
                    Paid
                </option>
                <option value="0" @selected(request('paid')==='0')>
                    Unpaid
                </option>
            </select>
            <button class="btn border btn-small-padding view-action">
                Search
            </button>
        </form>
        <a href="{{ route('technician-payroll.create') }}" class="btn-custom btn-primary-custom font-weight-bold create-role-action text-decoration-none">
            + Add Payroll
        </a>
    </div>
    <div class="panel customertypecontactphonesitesa-text">
        <div class="table-responsive-custom border">
            <table class="table-custom log-idtimestampuseractionentit-text-alt">
                <thead>
                    <tr>
                        <th>TECHNICIAN</th>
                        <th>TIME IN / OUT</th>
                        <th>AUTHORIZED</th>
                        <th>PAID</th>
                        <th>PAID CHECK</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payrolls as $p)
                    <tr>
                        <td>{{ $p->technician->name ?? 'Unknown technician' }}</td>
                        <td>{{ $p->time_in_out->format('M d, Y H:i') }}</td>
                        <td>{{ $p->authorized?'Yes':'No' }}</td>
                        <td>{{ $p->paid?'Yes':'No' }}</td>
                        <td>{{ $p->paid_check?'Yes':'No' }}</td>
                        <td class="jajohn-admin-text">
                            <a class="btn-action-simple text-decoration-none" href="{{ route('technician-payroll.show',$p) }}">View</a> 
                            <a class="btn-action-simple text-decoration-none" href="{{ route('technician-payroll.edit',$p) }}">Edit</a>
                            <form method="POST" action="{{ route('technician-payroll.destroy',$p) }}" class="d-inline" onsubmit="return confirm('Delete this payroll record?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-action-simple">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No payroll records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $payrolls->links() }}
        </div>
    </div>
</div>
@endsection