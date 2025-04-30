<tr>
    <td>
        #
    </td>
    <td>
        <input class="form-control" type="date" wire:model="tanggal">
    <td>
        <textarea wire:model="keluhan" class="form-control" cols="30" rows="1" placeholder="tambah"></textarea>
    </td>

    <td wire:ignore>
        <select id="divisi" class="divisi" wire:model="divisi_id">
            <option value="" selected>--PILIH DIVISI--</option>
            @foreach ($divisi as $divisis)
                <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
            @endforeach
        </select>
        @push('script')
        <script>
            new TomSelect(".divisi",{
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        </script>
        @endpush
    </td>

    <td class="text-center">
        @if ($foto_keluhans)
            <input type="file" accept="image/*" id="foto_keluhanpre" class="form-control d-none" wire:model="foto_keluhans">
            <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_keluhanpre').click()">
                <img class="img-thumbnail" src="{{ $foto_keluhans->temporaryUrl() }}" alt="Preview" style="max-height: 100px;">
            </div>
        @else
            <input type="file" accept="image/*" id="foto_keluhan" class="form-control d-none" wire:model="foto_keluhans">
            <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_keluhan').click()">
                <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
            </div>
        @endif

    </td>

    <td>
        <select wire:model="status" class="form-select">
            <option selected>-- Pilih Status --</option>
            <option value="Selesai">Selesai</option>
            <option value="Belum Selesai">Belum Selesai</option>
        </select>
    </td>
    <td>
    <button wire:click="save" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
        <iconify-icon icon="tabler:send"></iconify-icon>
    </button>
    </td>
</tr>
