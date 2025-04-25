<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div class="dropdown">
                <select name="bulan" id="bulan" class="form-select" wire:blur='waktu2'>
                    <option value="{{ $tanggal }}">{{ \Carbon\Carbon::parse($tanggal)->format('F') }}</option>
                    <option value="{{ now()->year }}-01-01">Januari</option>
                    <option value="{{ now()->year }}-02-01">Februari</option>
                    <option value="{{ now()->year }}-03-01">Maret</option>
                    <option value="{{ now()->year }}-04-01">April</option>
                    <option value="{{ now()->year }}-05-01">Mei</option>
                    <option value="{{ now()->year }}-06-01">Juni</option>
                    <option value="{{ now()->year }}-07-01">Juli</option>
                    <option value="{{ now()->year }}-08-01">Agustus</option>
                    <option value="{{ now()->year }}-09-01">September</option>
                    <option value="{{ now()->year }}-10-01">Oktober</option>
                    <option value="{{ now()->year }}-11-01">November</option>
                    <option value="{{ now()->year }}-12-01">Desember</option>
                </select>
            </div>
            <div class="dropdown">
                <select wire:model='waktu' class="form-select" id="tahun" aria-label="Pilih Opsi">
                    <option value="whereMonth" selected>Perbulan</option>
                    <option value="whereYear">Pertahun</option>
                    <option value="whereDay">Hari Ini</option>
                </select>
            </div>

        </div>
    </div>
    {{-- {{ $waktu2 }} --}}
    <div id="dashboardComponent">
        @livewire('It.DashboardComponent', ['waktu' => $waktu, 'waktu2' => $waktu2])
    </div>

</div>

@push('script')
<script>
    $(document).ready(function() {
        $('#bulan').on('change', function() {
            var selectedValue = $(this).val();
            var selectedValue2 = $("#tahun").val();
            // alert(selectedValue);
            let componentId = document.querySelector('#dashboardComponent [wire\\:id]').getAttribute('wire:id');
            // window.Livewire.find(componentId).call('setWaktu', selectedValue);
            window.location.href = '?tanggal=' + selectedValue + '&waktu=' + selectedValue2;

        });
        $('#tahun').on('change', function() {
            var selectedValue = $(this).val();
            // alert(selectedValue);
            // window.Livewire.find(componentId).call('setWaktu', selectedValue);
            if (selectedValue == 'whereDay') {
                window.location.href = '?tanggal=' + '{{ now()->format('Y-m-d') }}' + '&waktu=' + selectedValue;
            }else{
                window.location.href = '?waktu=' + selectedValue;
            }
        });
    });
</script>
@endpush
