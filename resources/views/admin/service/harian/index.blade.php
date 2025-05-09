@extends('admin.layouts.core')
@section('body')
@if (Auth::user()->jabatan == "Manager")
@livewire("Manager.SidebarManager")
@else
@livewire('SidebarService')
@endif


<main class="dashboard-main">
    @include('admin.layouts.topbar')
    <div class="dashboard-main-body">

        <div class="card basic-data-table">
            <div class="card-header">
              <h5 class="card-title mb-0">Report Harian Tim Service</h5>
            </div>
            <div class="card-body">
                {{-- @livewire('ReportServiceTable') --}}
                <div class="row">
                    @livewire('Service.HarianPageServiceNew')
                </div>
            </div>

        </div>
    </div>
</main>

@endsection
@section('script')

@endsection
