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
              <h5 class="card-title mb-0">Tambah Report Tim Service</h5>
            </div>
            <div class="card-body">
                @livewire('Service.FormTambahReportNew')
            </div>

        </div>
    </div>
</main>

@endsection
@section('script')
@endsection
