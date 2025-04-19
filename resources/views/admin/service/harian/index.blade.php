@extends('admin.layouts.core')
@section('body')
@livewire('SidebarService')


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
                    @livewire('LeaderBoardHarianService', ['tanggal' => now()->month, 'waktu' => 'whereMonth'])
                    <div class="col-xxl-12 col-lg-12">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection
@section('script')
<script src="{{ asset('wowdash/assets/js/lib/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('fullcalendar-6.1.17/dist/index.global.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            height: 550,
            headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'today'
            },
            events: [], // kosongin default event-nya
            dateClick: function(info) {
                // alert('Kamu klik tanggal: ' + info.dateStr);
                // window.location.href = 'harian/'+ info.dateStr;
            }
        });

        calendar.render();
    });
</script>
@endsection
