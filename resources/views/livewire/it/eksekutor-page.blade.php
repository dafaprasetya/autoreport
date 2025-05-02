<div>
    @if ($tanggal)
    <button class="btn btn-outline-primary-600 radius-8 px-20 py-11 d-flex align-items-center justify-content-center" wire:click='kembali'>
        <iconify-icon icon="lets-icons:back" width="24" height="24"></iconify-icon>
    </button>
    @livewire('It.EksekutorIt', ['tanggal' => $tanggal])
    @else
    @livewire('CalendarHarian')
    @endif
</div>

