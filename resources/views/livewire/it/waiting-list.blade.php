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
                    <th scope="col">Keluhan</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Foto Keluhan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @livewire('It.FormWaitingList')
                @foreach ($waiting as $waitings)
                <tr id="tr{{ $waitings->id }}">
                    <td>
                        <div class="form-check style-check d-flex align-items-center">
                            <label class="form-check-label">
                                {{ ($waiting->currentPage() - 1) * $waiting->perPage() + $loop->iteration }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <input class="form-control" type="date" value="{{ $waitings->tanggal }}" wire:blur="updateCell({{ $waitings->id }}, 'tanggal', $event.target.value)">
                    <td>
                        <textarea wire:blur="updateCell({{ $waitings->id }}, 'keluhan', $event.target.value)" class="form-control" id="keluhan{{ $waitings->id }}" cols="30" rows="1">{{ $waitings->keluhan }}</textarea>
                    </td>

                    <td>
                        <select id="divisi" class="form-select" wire:blur="updateCell({{ $waitings->id }}, 'divisi_id', $event.target.value)">
                            <option value="{{ $waitings->divisi->id }}" selected>{{ $waitings->divisi->nama }}</option>
                            @foreach ($divisi as $divisis)
                                <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="text-center">
                        @if ($waitings->foto_keluhan == '')
                            <!-- Input file hidden -->
                            <input type="file"
                                accept="image/*"
                                id="foto_keluhan{{ $waitings->id }}"
                                wire:model="foto_keluhan.{{ $waitings->id }}"
                                wire:model.change="foto_keluhan({{ $waitings->id }})"
                                class="form-control d-none"> <!-- hidden pakai d-none -->
                            <!-- Icon tambah jadi tombol upload -->
                            <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_keluhan{{ $waitings->id }}').click()">
                                <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
                            </div>

                            @if (isset($foto_keluhan[$waitings->id]))
                                <div class="mt-1">
                                    <img src="{{ $foto_keluhan[$waitings->id]->temporaryUrl() }}" alt="Preview" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif

                        @endif
                        @if ($waitings->foto_keluhan)
                            <!-- Input file hidden -->
                            <input
                                type="file" accept="image/*"
                                id="foto_keluhan{{ $waitings->id }}"
                                wire:model="foto_keluhan.{{ $waitings->id }}"
                                class="form-control d-none"> <!-- hidden pakai d-none -->
                            <!-- Preview image jadi tombol upload -->
                            <div class="mt-1" style="cursor: pointer;" onclick="document.getElementById('foto_keluhan{{ $waitings->id }}').click()">
                                @if (isset($foto_keluhan[$waitings->id]))
                                    <img src="{{ $foto_keluhan[$waitings->id]->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                                @else
                                    <img src="{{ asset('storage/it/waitinglist/'.$waitings->foto_keluhan) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                                @endif
                            </div>
                        @endif
                    </td>
                    <td>
                        <select wire:blur="updateCell({{ $waitings->id }}, 'status', $event.target.value)" class="form-select">
                            <option value="{{ $waitings->status }}" selected>{{ $waitings->status }}</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Belum Selesai">Belum Selesai</option>
                        </select>
                    </td>
                    <td>
                        <button wire:click="deleteReport({{ $waitings->id }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                        @if ($waitings->dibuatOleh)
                        <button data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-title="Dibuat oleh {{ $waitings->dibuat_oleh->name }} pada tanggal {{ \Carbon\Carbon::parse($waitings->created_at)->format('d F Y') }}" class="w-32-px h-32-px bg-info-focus text-info-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="material-symbols:info-rounded"></iconify-icon>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $waiting->links('livewire::bootstrap') }}
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
