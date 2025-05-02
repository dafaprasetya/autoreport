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

@push('script')
<script>

    $(document).ready(function () {
        console.log('hai');

    });
    window.addEventListener('refresh', () => {
        $(document).ready(function() {
            console.log('hai berhasil coy');

        });
    });
    Livewire.on('loadtom', () => {
        // alert("berhasil masuk")
        document.querySelectorAll('.divisi').forEach(select => {
            if (select.tomselect) {
                select.tomselect.destroy();
            }

            new TomSelect(select, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    });
    Livewire.on('jsload', () => {
        console.log('hai berhasil pooling');
        document.querySelectorAll('.divisi').forEach(select => {
            if (select.tomselect) {
                select.tomselect.destroy();
            }

            new TomSelect(select, {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    });
</script>
@endpush
