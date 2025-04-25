<div wire:poll>
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
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary-light line-height-1">1-10 of {{ $total }}</span>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <button wire:click="previousPage" class="page-link d-flex bg-base border text-secondary-light text-xl"><iconify-icon icon="iconamoon:arrow-left-2" class="icon"></iconify-icon> </button>
                        </li>
                        <li class="page-item">
                            <button wire:click="nextPage" class="page-link d-flex bg-base border text-secondary-light text-xl"><iconify-icon icon="iconamoon:arrow-right-2" class="icon"></iconify-icon> </button>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>

    <div class="table-responsive">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Tanggal Keluhan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">User</th>
                    <th scope="col">Deskripsi Pekerjaan</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Jenis Pekerjaan</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Foto Before</th>
                    <th scope="col">Foto After</th>
                    <th scope="col">Tanggal Selesai</th>
                    <th scope="col">Lead Time</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $reports)
                <tr id="tr{{ $reports->id }}">
                    <td>
                    <div class="form-check style-check d-flex align-items-center">
                        <label class="form-check-label">
                            {{ $total - (($report->currentPage() - 1) * $report->perPage() + $loop->index) }}
                        </label>
                    </div>
                    </td>
                    <td><a href="#{{ $reports->tanggal }}" class="text-primary-600">{{ $reports->tanggal }}</a></td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'keterangan', $event.target.value)" class="form-select" id="kategori{{ $reports->id }}">
                            <option value="{{ $reports->keterangan }}" selected>{{ $reports->keterangan }}</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'user_id', $event.target.value)" class="form-select" id="user{{ $reports->id }}">
                            <option value="{{ $reports->user_id }}" selected>{{ $reports->user->name }}</option>
                            @foreach ($user as $users)
                                <option value="{{ $users->id }}">{{ $users->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <textarea wire:blur="updateCell({{ $reports->id }}, 'deskripsi_pekerjaan', $event.target.value)" class="form-control" id="deskripsi_pekerjaan{{ $reports->id }}" cols="30" rows="3">{{ $reports->deskripsi_pekerjaan }}</textarea>
                    </td>
                    <td>
                        <select class="form-select" id="jenis_pekerjaan{{ $reports->id }}" class="divisi">
                            <option value="{{ $reports->user_id }}" selected>{{ $reports->divisi->nama }}</option>
                            @foreach ($divisi as $divisis)
                                <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'jenis_pekerjaan_id', $event.target.value)" class="form-select" id="divisi{{ $reports->id }}" class="divisi">
                            <option value="{{ $reports->jenis_pekerjaan_id }}" selected>{{ $reports->jenis_pekerjaan->nama }}</option>
                            @foreach ($jenispekerjaan as $jenispekerjaans)
                                <option value="{{ $jenispekerjaans->id }}">{{ $jenispekerjaans->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $reports->id }}, 'lokasi_id', $event.target.value)" class="form-select" id="lokasi{{ $reports->id }}" class="divisi">
                            <option value="{{ $reports->lokasi_id }}" selected>{{ $reports->lokasi->nama }}</option>
                            @foreach ($lokasi as $lokasis)
                                <option value="{{ $lokasis->id }}">{{ $lokasis->nama }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="text-center">
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
                                    <img src="{{ asset('storage/service/foto_before/'.$reports->foto_before) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
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
                                    <img src="{{ asset('storage/service/foto_after/'.$reports->foto_after) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                                @endif
                            </div>
                        @endif
                        {{-- <input type="file" wire:model="fotoAfter.{{ $reports->id }}">
                        <button wire:click="uploadFoto({{ $reports->id }}, 'after')" class="btn btn-primary btn-sm mt-1">Upload After</button> --}}
                    </td>


                    {{-- <td>{{ $reports->foto_after }}</td> --}}
                    <td>
                        <input class="form-control" type="date" value="{{ $reports->tanggal_selesai }}" wire:blur="updateCell({{ $reports->id }}, 'tanggal_selesai', $event.target.value)">
                    </td>
                    <td>{{ $reports->lead_time }}</td>
                    <td>
                    <button  wire:click="deleteReport({{ $reports->id }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </button>
                    @if ($reports->dibuatOleh)
                    <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="Dibuat oleh {{ $reports->dibuat_oleh->name }} pada tanggal {{ \Carbon\Carbon::parse($reports->created_at)->format('d F Y') }}" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="material-symbols:info-rounded"></iconify-icon>
                    </button>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $report->links('livewire::bootstrap') }}
    </div>
</div>
@push('script')
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Boxed Tooltip
    $(document).ready(function() {
        $('.tooltip-button').each(function () {
            var tooltipButton = $(this);
            var tooltipContent = $(this).siblings('.my-tooltip').html();

            // Initialize the tooltip
            tooltipButton.tooltip({
                title: tooltipContent,
                trigger: 'hover',
                html: true
            });

            // Optionally, reinitialize the tooltip if the content might change dynamically
            tooltipButton.on('mouseenter', function() {
                tooltipButton.tooltip('dispose').tooltip({
                    title: tooltipContent,
                    trigger: 'hover',
                    html: true
                }).tooltip('show');
            });
        });
    });
</script>
@endpush
