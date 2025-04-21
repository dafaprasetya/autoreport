<div class="d-flex justify-content-between align-items-center">
    <div class="dropdown">
        <select name="bulan" id="bulan" class="form-select" wire:blur='waktu2'>
            <option value="{{ $tanggal }}">{{ \Carbon\Carbon::parse($tanggal)->format('F') }}</option>
            <option value="2025-01-01">Januari</option>
            <option value="2025-02-01">Februari</option>
            <option value="2025-03-01">Maret</option>
            <option value="2025-04-01">April</option>
            <option value="2025-05-01">Mei</option>
            <option value="2025-06-01">Juni</option>
            <option value="2025-07-01">Juli</option>
            <option value="2025-08-01">Agustus</option>
            <option value="2025-09-01">September</option>
            <option value="2025-10-01">Oktober</option>
            <option value="2025-11-01">November</option>
            <option value="2025-12-01">Desember</option>
        </select>
    </div>
    <div class="dropdown">
    <select wire:model='waktu' class="form-select" aria-label="Pilih Opsi">
        <option value="whereMonth" selected>Perbulan</option>
        <option value="whereYear">Pertahun</option>
    </select>
    </div>
</div>
