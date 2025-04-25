<div>
    <hr>
    <div class="card-header border-bottom bg-base py-16 px-24">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
            <div class="d-flex align-items-center gap-3">
                <button wire:click="$refresh" type="button" class="reload-button text-secondary-light text-xl d-flex">
                    <iconify-icon icon="tabler:reload" class="icon"></iconify-icon>
                </button>
                <div class="navbar-search d-lg-block d-none">
                    <input wire:model.live.debounce.250ms="search" type="text" class="bg-base h-40-px w-auto" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </div>

            </div>

            @if (session()->has('message'))
            <div class="d-flex align-items-center">
                    <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('message') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
            </div>
            @endif

        </div>
    </div>

    <div class="table-responsive" wire:poll>
        <table class="table bordered-table mb-0">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Agenda</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Detail Kerja</th>
                    <th scope="col">Point</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $reports)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <textarea wire:blur="updateCell({{ $reports->id }}, 'agenda', $event.target.value)" cols="30" class="form-control" rows="2">{{ $reports->agenda }}</textarea>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'kategori_harian_id', $event.target.value)" class="form-select">
                            <option value="{{ $reports->kategori_harian_id }}" selected>{{ $reports->kategoriHarian->nama }}</option>
                            @foreach ($kategori as $kategoris)
                                <option value="{{ $kategoris->id }}">{{ $kategoris->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'user_id', $event.target.value)" class="form-select">
                            <option value="{{ $reports->user_id }}" selected>{{ $reports->user->name }} - {{ $reports->user->jabatan }}</option>
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }} - {{ $users->jabatan }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'status', $event.target.value)" class="form-select">
                            <option value="{{ $reports->status }}" selected>{{ $reports->status }}</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Belum Selesai">Belum Selesai</option>
                        </select>
                    </td>
                    <td>
                        <textarea wire:blur="updateCell({{ $reports->id }}, 'detail_kerja', $event.target.value)" cols="30" class="form-control" rows="2">{{ $reports->detail_kerja }}</textarea>

                    </td>
                    <td>
                        {{ $reports->poin }}
                    </td>
                    <td>
                        <button wire:click="deleteReport({{ $reports->id }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                        @if ($reports->dibuatOleh)
                        <button onclick="alert('Dibuat oleh {{ $reports->dibuat_oleh->name }} pada tanggal {{ \Carbon\Carbon::parse($reports->created_at)->format('d F Y') }}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="material-symbols:info-rounded"></iconify-icon>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@push('script')

@endpush
