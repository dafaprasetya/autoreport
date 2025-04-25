@extends('admin.layouts.core')
@section('body')
@livewire('SidebarIT')

<main class="dashboard-main">
    @include('admin.layouts.topbar')
    <div class="dashboard-main-body">

        <div class="card basic-data-table">
            <div class="card-header">
              <h5 class="card-title mb-0">Waiting List Tim IT</h5>
            </div>
            <div class="card-body">
                @livewire('It.WaitingList')
            </div>
        </div>
    </div>
</main>

@endsection
@section('script')
@endsection
