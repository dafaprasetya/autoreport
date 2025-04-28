@extends('admin.layouts.core')
@section('body')
@livewire('SidebarIT')


<main class="dashboard-main">
    @include('admin.layouts.topbar')
    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Manage Users</h6>
            <ul class="d-flex align-items-center gap-2">
              <li class="fw-medium">
                <a href="{{ route('dashboardService') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                  <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                  Dashboard
                </a>
              </li>
            </ul>
        </div>
        {{-- {{ \Carbon\Carbon::parse($tanggal) }} --}}
        @livewire('It.ManageUser')
    </div>
</main>

@endsection
@section('script')

@endsection
