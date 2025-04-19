<div class="row mt-3">
    {{-- <form wire:submit='postForm'> --}}
        <div class="row">
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
                        <option value="Ekternal">External</option>
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
                    <label class="form-label" for="keterangan">Deskripsi Pekerjaan</label>
                    <textarea rows="1" class="form-control" wire:model="deskripsi_pekerjaan" placeholder="Masukan Deskripsi Pekerjaan"></textarea>
                    <div>
                        @error('deskripsi_pekerjaan') <span class="error text-danger">{{ $message }}</span> @enderror
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
                    <label class="form-label" for="jenis_pekerjaan_id">Lokasi</label>
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
                    <label class="form-label" for="tanggal">Tanggal Selesai</label>
                    <input class="form-control" type="date" wire:model="tanggal_selesai">
                    <div>
                        @error('tanggal_selesai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <button wire:click="save" class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </div>
    {{-- </form> --}}
</div>
