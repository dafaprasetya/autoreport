@extends('admin.layouts.core')
@section('body')
@livewire('SidebarService')

<main class="dashboard-main">
    @include('admin.layouts.topbar')
    <div class="dashboard-main-body">

        <div class="card basic-data-table">
            <div class="card-header">
              <h5 class="card-title mb-0">Report Eksekutor Tim Service</h5>
            </div>
            <div class="card-body">
                @livewire('Service.EksekutorPage')
            </div>

        </div>
    </div>
</main>

@endsection
@section('script')
@endsection
