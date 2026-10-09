@extends('layouts.master')

@section('topbar-title', 'Customer Type Detail')

@section('page-title', 'WorkOrder Pro - Customer Type Detail')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <div class="content-area">
      <div class="manage-usersall-work-ordersvie-text">
        <h2 class="page-title font-weight-bold manage-usersall-work-ordersvie-text-h-custom">
                Customer Type detail</h2>
        <p class="manage-usersall-work-ordersvie-text-p-custom-primary">
            Customer Types / {{ $customerType->name }} · #{{ $customerType->id }}
        </p>
    </div>

    <div class="panel border display-flex acacme-corporationactivecommer-text">
        <div class="avatar-square avatar-square-green display-flex avatar-square-lg panel-div-secondary">
        {{ collect(preg_split('/\s+/', trim($customerType->name)))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->join('') }}
        </div>
         <div>
          <div class="font-weight-bold display-flex acme-corporationactive-text-alt">
                {{ $customerType->name }}
            </div>
            <div class="users-text">{{ $customerType->sites_count }} service site(s) assigned</div>
        </div>
    </div>

<div class="panel border siteaddressactive-woslast-serv-text mt-4">
    <div class="table-responsive-custom">
        <table class="table-custom log-idtimestampuseractionentit-text-alt">
            <thead>
                <tr>
                    <th class="font-weight-bold log-id-text">SITE</th>
                    <th class="font-weight-bold log-id-text">ADDRESS</th>
                    <th class="font-weight-bold log-id-text">STATE</th>
                </tr>
            </thead>
            <tbody>
            @forelse($customerType->sites as $site)
                <tr>
                    <td class="font-weight-bold jun-am-text">{{ $site->name }}</td>
                    <td class="market-st-san-francisco-text">
                        {{ $site->address ?: '—' }}{{ $site->city ? ', '.$site->city : '' }}
                    </td>
                    <td class="market-st-san-francisco-text">{{ $site->state ?: '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center py-4">No sites are assigned to this customer type.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="display-flex create-role-text gap-2 mt-4">
    <a class="btn btn-outline-secondary border font-weight-bold btn-outline-padding-wide text-decoration-none"
       href="{{ route('customer-types.index') }}">Back</a>
    <a class="btn btn-success px-4 py-2 font-weight-bold text-white text-decoration-none"
       href="{{ route('customer-types.edit', $customerType) }}">Edit</a>
    @if($customerType->sites_count === 0)
        <form method="POST" action="{{ route('customer-types.destroy', $customerType) }}"
              onsubmit="return confirm('Delete this customer type?');">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger px-4 py-2 font-weight-bold" type="submit">Delete</button>
        </form>
    @endif
</div>
@endsection
