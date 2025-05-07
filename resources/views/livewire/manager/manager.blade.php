<div>
    @if ($page == "dashboardIT")
    <div class="dashboard-main-body">

        <div class="card basic-data-table">
            <div class="card-header">
              <h5 class="card-title mb-0">Report Eksekutor Tim Service</h5>
            </div>
            <div class="card-body">
                @livewire('It.Dashboard', ['waktu' => $waktu, 'waktu2' => $tanggal ? \Carbon\Carbon::parse($tanggal) : now()])
            </div>

        </div>
    </div>
    @endif
</div>

@push('script')
@endpush
