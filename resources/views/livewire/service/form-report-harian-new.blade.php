<div class="row mt-3">
    {{-- <form wire:submit='postForm'> --}}
        <div class="row">
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="tanggal">Agenda</label>
                    <textarea wire:model='agenda' class="form-control" id="" rows="2"></textarea>
                    <div>
                        @error('agenda') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
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
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <div class="form-label">Tanggal Penugasan</div>
                    <input type="date" class="form-select" wire:model.defer="tanggal_penugasan">
                    <div>
                        @error('tanggal_penugasan') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <div class="form-label">Target Selesai</div>
                    <input type="date" class="form-select" wire:model.defer="target_selesai">
                    <div>
                        @error('target_selesai') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <div class="form-label">User</div>
                    <select wire:model.defer="user_id" class="form-select">
                        <option value="">-- Pilih User --</option>
                        @foreach ($userlist as $users)
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
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="tanggal">Detail Kerja</label>
                    <textarea class="form-control" id="" rows="2" wire:model="detail_kerja"></textarea>
                    <div>
                        @error('detail_kerja') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="form-group">
                    <label class="form-label" for="tanggal">Note progres</label>
                    <textarea class="form-control" id="" rows="2" wire:model="note_progres"></textarea>
                    <div>
                        @error('note_progres') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <button wire:click="postForm" class="btn btn-primary w-100">Submit</button>
                    <div>
                        @error('title') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    {{-- </form> --}}
</div>
