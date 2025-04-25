<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if($tanggal)
    <button class="btn btn-outline-primary-600 radius-8 px-20 py-11 d-flex align-items-center justify-content-center" wire:click='kembali'>
        <iconify-icon icon="lets-icons:back" width="24" height="24"></iconify-icon>
    </button>
    @livewire('It.Leaderboard', ['tanggal' => $tanggal, 'waktu' => 'whereDate'])
    <div class="row mt-3 mb-3">
        <div class="col-lg-12">
            <button class="btn btn-outline-primary-600 radius-8 px-20 py-11 w-100 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#tambahReportHarianModal">
                <span class="me-2">Tambah</span>
                <iconify-icon icon="formkit:add" width="20" height="20"></iconify-icon>
            </button>
            <div class="modal fade" id="tambahReportHarianModal" tabindex="-1" aria-labelledby="tambahReportHarianModal" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Report Harian {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @livewire('It.FormReportHarian',['tanggal' => $tanggal])

                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('It.ReportHarian', ['tanggal' => $tanggal])
    @else
        @livewire('It.Leaderboard', ['tanggal' => now()->month, 'waktu' => 'whereMonth'])
        @livewire('CalendarHarian')
    @endif
</div>
