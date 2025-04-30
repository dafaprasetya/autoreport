<div>
    <hr>
    <div class="card-header border-bottom bg-base py-16 px-24" wire:poll>
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
    @if ($modalTambah)
    <div class="modal fade show" class="modal fade" id="tambahReportModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Report</h5>
                    <button type="button" class="btn-close" wire:click="closeModalTambah" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('Service.FormTambahReportNew', [
                        'agenda' => $selectedReport->deskripsi_pekerjaan,
                        'kategori_harian_id' => $selectedReport->kategori_harian_id,
                        'tanggal' => $selectedReport->tanggal,
                        'keterangan' => 'Internal',
                        'user_id' => $selectedReport->user_id,
                        'detail_kerja' => $selectedReport->deskripsi_pekerjaan,
                        'divisi_id' => $selectedReport->divisi_id,
                        'jenis_pekerjaan_id' => $selectedReport->jenis_pekerjaan_id,
                        'lokasi_id' => $selectedReport->lokasi_id,
                        'eksekutors' => true,
                        'foto_before' => $selectedReport->foto_before,
                        'foto_after' => $selectedReport->foto_after,
                        'report_eksekutor_id' => $selectedReport->id,
                    ], key('form-' . $selectedReport->id))

                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>

    @endif
    <div class="table-responsive">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Eksekutor/User</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Deskripsi Pekerjaan</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Kategori Harian</th>
                    <th scope="col">Jenis Pekerjaan</th>
                    <th scope="col">Foto</th>
                    {{-- <th scope="col">Foto After</th> --}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $reports)
                @if ($reports->status == 'Sudah Ditambahkan')
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reports->user->name }}</td>
                    <td>{{ $reports->tanggal }}</td>
                    <td>{{ $reports->deskripsi_pekerjaan }}</td>
                    <td>{{ $reports->lokasi->nama }}</td>
                    <td>{{ $reports->divisi->nama }}</td>
                    <td>{{ $reports->kategoriHarian->nama }}</td>
                    <td>{{ $reports->jenis_pekerjaan->nama }}</td>
                    <td>
                        <img src="{{ asset('storage/reporteksekutor/foto_before/'.$reports->foto_before) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                    </td>
                    <td>
                        <button wire:click="deleteReport({{ $reports->id }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                    </td>
                </tr>
                @else

                <tr>
                    <td>
                        {{ $loop->iteration }}
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
                        <input class="form-control" type="date" value="{{ $reports->tanggal }}" wire:blur="updateCell({{ $reports->id }}, 'tanggal', $event.target.value)">
                    </td>
                    <td>
                        <textarea wire:blur="updateCell({{ $reports->id }}, 'deskripsi_pekerjaan', $event.target.value)" cols="30" class="form-control" rows="2">{{ $reports->deskripsi_pekerjaan }}</textarea>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'lokasi_id', $event.target.value)" class="form-select">
                            @if ($reports->lokasi_id)
                            <option value="{{ $reports->lokasi_id }}" selected>{{ $reports->lokasi->nama }}</option>
                            @else
                            <option value="0" selected>-- Pilih Lokasi --</option>
                            @endif
                            @foreach ($lokasi as $lokasis)
                                <option value="{{ $lokasis->id }}">{{ $lokasis->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'divisi_id', $event.target.value)" class="form-select">
                            @if ($reports->divisi_id)
                            <option value="{{ $reports->divisi_id }}" selected>{{ $reports->divisi->nama }}</option>
                            @else
                            <option value="0" selected>-- Pilih Divisi --</option>
                            @endif
                            @foreach ($divisi as $divisis)
                                <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'kategori_harian_id', $event.target.value)" class="form-select">
                            @if ($reports->kategori_harian_id)
                            <option value="{{ $reports->kategori_harian_id }}" selected>{{ $reports->kategoriHarian->nama }}</option>
                            @else
                            <option value="0" selected>-- Pilih Kategori Harian --</option>
                            @endif
                            @foreach ($kategori as $kategori_harian_ids)
                                <option value="{{ $kategori_harian_ids->id }}">{{ $kategori_harian_ids->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'jenis_pekerjaan_id', $event.target.value)" class="form-select">
                            @if ($reports->jenis_pekerjaan_id)
                            <option value="{{ $reports->jenis_pekerjaan_id }}" selected>{{ $reports->jenis_pekerjaan->nama }}</option>
                            @else
                            <option value="0" selected>-- Pilih Jenis Pekerjaan --</option>
                            @endif
                            @foreach ($jenispekerjaan as $jenis_pekerjaan)
                                <option value="{{ $jenis_pekerjaan->id }}">{{ $jenis_pekerjaan->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        @if ($reports->foto_before == '')
                            <!-- Input file hidden -->
                            <input type="file"
                                accept="image/*"
                                id="fotoBefore{{ $reports->id }}"
                                wire:model="fotoBefore.{{ $reports->id }}"
                                wire:model.change="uploadFoto({{ $reports->id }}, 'before')"
                                class="form-control d-none"> <!-- hidden pakai d-none -->
                            <!-- Icon tambah jadi tombol upload -->
                            <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('fotoBefore{{ $reports->id }}').click()">
                                <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
                            </div>

                            @if (isset($fotoBefore[$reports->id]))
                                <div class="mt-1">
                                    <img src="{{ $fotoBefore[$reports->id]->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif

                        @endif
                        @if ($reports->foto_before)
                            <!-- Input file hidden -->
                            <input
                                type="file" accept="image/*"
                                id="fotoBefore{{ $reports->id }}"
                                wire:model="fotoBefore.{{ $reports->id }}"
                                class="form-control d-none"> <!-- hidden pakai d-none -->
                            <!-- Preview image jadi tombol upload -->
                            <div class="mt-1" style="cursor: pointer;" onclick="document.getElementById('fotoBefore{{ $reports->id }}').click()">
                                @if (isset($fotoBefore[$reports->id]))
                                    <img src="{{ $fotoBefore[$reports->id]->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                                @else
                                    <img src="{{ asset('storage/reporteksekutor/foto_before/'.$reports->foto_before) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                                @endif
                            </div>
                        @endif
                    </td>
                    {{-- <td>
                        @if ($reports->foto_after == '')
                        <input type="file" accept="image/*"
                               id="fotoAfter{{ $reports->id }}"
                               wire:model="fotoAfter.{{ $reports->id }}"
                               wire:model.change="uploadFoto({{ $reports->id }}, 'after')"
                               class="form-control d-none">
                            <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('fotoAfter{{ $reports->id }}').click()">
                                <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
                            </div>
                        @if (isset($fotoAfter[$reports->id]))
                            <div class="mt-1">
                                <img src="{{ $fotoAfter[$reports->id]->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif

                    @endif
                    @if ($reports->foto_after)
                        <!-- Input file hidden -->
                        <input
                            type="file" accept="image/*"
                            id="fotoAfter{{ $reports->id }}"
                            wire:model="fotoAfter.{{ $reports->id }}"
                            class="form-control d-none"> <!-- hidden pakai d-none -->
                        <!-- Preview image jadi tombol upload -->
                        <div class="mt-1" style="cursor: pointer;" onclick="document.getElementById('fotoAfter{{ $reports->id }}').click()">
                            @if (isset($fotoAfter[$reports->id]))
                                <img src="{{ $fotoAfter[$reports->id]->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                            @else
                                <img src="{{ asset('storage/reporteksekutor/foto_after/'.$reports->foto_after) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                            @endif
                        </div>
                    @endif
                    </td> --}}
                    <td>
                        <button wire:click="deleteReport({{ $reports->id }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                        @if ($reports->status == 'Belum Ditambahkan')
                            <button wire:click="tambahreport({{ $reports->id }})" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="gridicons:add"></iconify-icon>
                            </button>
                        @endif
                    </td>

                </tr>
                @endif
                @endforeach

            </tbody>
        </table>
    </div>

</div>

@push('script')

@endpush
