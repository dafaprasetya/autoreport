@extends('admin.layouts.core')
@section('body')
@livewire('Manager.SidebarManager')


<main class="dashboard-main">
    @include('admin.layouts.topbar')
    @livewire("Manager.Manager")
</main>

@endsection
@section('script')

@endsection
