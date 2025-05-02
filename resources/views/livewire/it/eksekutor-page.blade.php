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
        document.querySelectorAll('.divisi').forEach(select => {
            if (!select.classList.contains('ts-initialized')) {
                new TomSelect(select, {});
                select.classList.add('ts-initialized');
            }
        })

    });
    Livewire.on('jsload', () => {
        console.log('hai berhasil pooling');
        document.querySelectorAll('.divisi').forEach(select => {
            setTimeout(() => {
                if (!select.classList.contains('ts-initialized')) {
                    new TomSelect(select, {});
                    select.classList.add('ts-initialized');
                }
            }, 3000);
        })
    });
    // document.addEventListener('livewire:init', ()=>(
    //     Livewire.hook('message.processed', ({message, component}) => {
    //         // console.log(el);
    //         component.el.querySelectorAll('.divisi').forEach(select => {
    //             if (!select.classList.contains('ts-initialized')) {
    //                 new TomSelect(select, {});
    //                 select.classList.add('ts-initialized');
    //             }
    //         })
    //         // new TomSelect(".divisi"{})
    //         // $(".divisi").classList.add('ts-initialized')

    //     })
    // ))
</script>
@endpush
