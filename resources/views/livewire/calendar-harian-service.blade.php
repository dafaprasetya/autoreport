<div class="col-xxl-12 col-lg-12 mt-3">
    <div id="calendar"></div>
</div>

@push('script')
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
            right: ''
            },
            events: [], // kosongin default event-nya
            dateClick: function(info) {
                // alert('Kamu klik tanggal: ' + info.dateStr);
                // window.location.href = 'harian/'+ info.dateStr;
                var clickedDate = info.dateStr;
                window.Livewire.dispatch('setTanggal', { tanggal: clickedDate });
            }
        });

        calendar.render();
    });
    window.addEventListener('reset-calendar', () => {
        $(document).ready(function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap5',
                initialView: 'dayGridMonth',
                height: 550,
                headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: ''
                },
                events: [], // kosongin default event-nya
                dateClick: function(info) {
                    // alert('Kamu klik tanggal: ' + info.dateStr);
                    // window.location.href = 'harian/'+ info.dateStr;
                    var clickedDate = info.dateStr;
                    window.Livewire.dispatch('setTanggal', { tanggal: clickedDate });
                }
            });

            calendar.render();
        });
    });
</script>

@endpush
