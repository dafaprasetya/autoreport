<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label class="form-label" for="agenda">Agenda</label>
                    <textarea wire:model='agenda' class="form-control" id="" rows="1" placeholder="Masukan Agenda"></textarea>
                    <div>
                        @error('agenda') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <div class="form-label">Kategori</div>
                    <select wire:model.defer="kategori_harian_id" class="form-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kategoris)
                        <option value="{{ $kategoris->id }}">{{ $kategoris->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('kategori_harian_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label class="form-label" for="tanggal">Tanggal keluhan</label>
                    <input class="form-control" type="date" wire:model="tanggal">
                    <div>
                        @error('tanggal') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="keterangan">Keterangan</label>
                    <select class="form-select" wire:model="keterangan">
                        <option selected>--Pilih Keterangan --</option>
                        <option value="Internal">Internal</option>
                        <option value="External">External</option>
                    </select>
                    <div>
                        @error('keterangan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="user_id">User</label>
                    <select class="form-select" wire:model="user_id">
                        <option selected>-- Pilih User --</option>
                        @foreach ($user as $users)

                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="detail_kerja">Deskripsi Pekerjaan/Detail Kerja</label>
                    <textarea rows="1" class="form-control" wire:model="detail_kerja" placeholder="Masukan Deskripsi Pekerjaan"></textarea>
                    <div>
                        @error('detail_kerja') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="divisi_id">Divisi</label>
                    <select class="form-select" wire:model="divisi_id">
                        <option selected>-- Pilih Divisi --</option>
                        @foreach ($divisi as $divisis)

                        <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('divisi_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="jenis_pekerjaan_id">Jenis Pekerjaan</label>
                    <select class="form-select" wire:model="jenis_pekerjaan_id">
                        <option selected>-- Pilih Jenis Pekerjaan --</option>
                        @foreach ($jenispekerjaan as $jenis_pekerjaans)

                        <option value="{{ $jenis_pekerjaans->id }}">{{ $jenis_pekerjaans->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('jenis_pekerjaan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="lokasi">Lokasi</label>
                    <select class="form-select" wire:model="lokasi_id">
                        <option selected>-- Pilih Lokasi --</option>
                        @foreach ($lokasi as $lokasis)

                        <option value="{{ $lokasis->id }}">{{ $lokasis->nama }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('lokasi_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="foto_before">Foto Before</label>
                    @if ($foto_before)
                        <input type="file" accept="image/*" id="foto_beforepre" class="form-control d-none" wire:model="foto_before">
                        <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_beforepre').click()">
                            <img src="{{ $foto_before->temporaryUrl() }}" alt="Preview" style="max-width: 200px; margin-top: 10px;">
                        </div>
                    @else
                        <input type="file" accept="image/*" id="foto_before" class="form-control d-none" wire:model="foto_before">
                        <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_before').click()">
                            <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
                        </div>
                    @endif
                    <div>
                        @error('foto_before') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="foto_before">Foto After</label>
                    @if ($foto_after)
                        <input type="file" accept="image/*" id="foto_afterpre" class="form-control d-none" wire:model="foto_after">
                        <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_afterpre').click()">
                            <img src="{{ $foto_after->temporaryUrl() }}" alt="Preview" style="max-width: 200px; margin-top: 10px;">
                        </div>
                    @else
                        <input type="file" accept="image/*" id="foto_after" class="form-control d-none" wire:model="foto_after">
                        <div class="d-flex justify-content-center" style="cursor: pointer; font-size: 2rem;" onclick="document.getElementById('foto_after').click()">
                            <iconify-icon icon="akar-icons:circle-plus" class="text-primary-600 text-5xl"></iconify-icon>
                        </div>
                    @endif
                    <div>
                        @error('foto_after') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <div class="form-label">Status</div>
                    <select class="form-select" wire:model="status">
                        <option value="">-- Pilih STATUS --</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Belum Selesai">Belum Selesai</option>
                    </select>
                    <div>
                        @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label class="form-label" for="tanggal">Tanggal Selesai</label>
                    <input class="form-control" type="date" wire:model="tanggal_selesai">
                    <div>
                        @error('tanggal_selesai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <button wire:click="tambahMasternHarian" class="btn btn-primary w-100">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mt-3 text-center">
        <h4>Data Yang Baru ditambahkan</h4>
    </div>
    <div class="col-lg-12 mt-3" wire:poll>
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
                    @foreach ($reportMBaru as $index=>$reports)
                    <tr id="tr{{ $reports->id }}">
                        <td>
                        <div class="form-check style-check d-flex align-items-center">
                            <label class="form-check-label">
                                {{ $loop->iteration }}
                            </label>
                        </div>
                        </td>
                        <td><a href="#{{ $reports->tanggal }}" class="text-primary-600">{{ $reports->tanggal }}</a></td>
                        <td>
                            <select wire:blur="updateCellMaster({{ $reports->id }}, 'keterangan', $event.target.value)" class="form-select" id="kategori{{ $reports->id }}">
                                <option value="{{ $reports->keterangan }}" selected>{{ $reports->keterangan }}</option>
                                <option value="Internal">Internal</option>
                                <option value="Ekternal">External</option>
                            </select>
                        </td>
                        <td>
                            <select wire:blur="updateCellMaster({{ $reports->id }}, 'user_id', $event.target.value)" class="form-select" id="user{{ $reports->id }}">
                                <option value="{{ $reports->user_id }}" selected>{{ $reports->user->name }}</option>
                                @foreach ($user as $users)
                                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <textarea wire:blur="updateCellMaster({{ $reports->id }}, 'deskripsi_pekerjaan', $event.target.value)" class="form-control" id="deskripsi_pekerjaan{{ $reports->id }}" cols="30" rows="3">{{ $reports->deskripsi_pekerjaan }}</textarea>
                        </td>
                        <td>
                            <select class="form-select" id="jenis_pekerjaan{{ $reports->id }}" class="divisi">
                                <option value="{{ $reports->divisi_id }}" selected>{{ $reports->divisi->nama }}</option>
                                @foreach ($divisi as $divisis)
                                    <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select wire:blur="updateCellMaster({{ $reports->id }}, 'jenis_pekerjaan_id', $event.target.value)" class="form-select" id="divisi{{ $reports->id }}" class="divisi">
                                <option value="{{ $reports->jenis_pekerjaan_id }}" selected>{{ $reports->jenis_pekerjaan->nama }}</option>
                                @foreach ($jenispekerjaan as $jenispekerjaans)
                                    <option value="{{ $jenispekerjaans->id }}">{{ $jenispekerjaans->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select wire:blur="updateCellMaster({{ $reports->id }}, 'lokasi_id', $event.target.value)" class="form-select" id="lokasi{{ $reports->id }}" class="divisi">
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
                                        <img src="{{ asset('storage/it/foto_before/'.$reports->foto_before) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
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
                                        <img src="{{ asset('storage/it/foto_after/'.$reports->foto_after) }}" alt="Uploaded" class="img-thumbnail" style="max-height: 100px;">
                                    @endif
                                </div>
                            @endif
                            {{-- <input type="file" wire:model="fotoAfter.{{ $reports->id }}">
                            <button wire:click="uploadFoto({{ $reports->id }}, 'after')" class="btn btn-primary btn-sm mt-1">Upload After</button> --}}
                        </td>


                        {{-- <td>{{ $reports->foto_after }}</td> --}}
                        <td>
                            <input class="form-control" type="date" value="{{ $reports->tanggal_selesai }}" wire:blur="updateCellMaster({{ $reports->id }}, 'tanggal_selesai', $event.target.value)">
                        </td>
                        <td>{{ $reports->lead_time }}</td>
                        <td>
                        <button wire:click="deleteReportMaster({{ $reports->id }}, {{ $index }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                        </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-12 mt-3" wire:poll>
        <div class="table-responsive">
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
                    {{-- {{ dd($listReportHarian) }} --}}
                    @foreach ($reportHBaru as $index=>$reports)
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
                            <button wire:click="deleteReportHarian({{ $reports->id }}, {{ $index }})" onclick="confirm('Yakin hapus data ini?') || event.stopImmediatePropagation()" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
