<div class="row mt-3">
    {{-- <form wire:submit='postForm'> --}}
        <div class="row">
            @if (session()->has('message'))
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                        <div id="liveToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('message') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                var toastEl = document.getElementById('liveToast');
                                if (toastEl) {
                                    var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                                    toast.show();
                                }
                            });
                        </script>
                </div>
            </div>
            @endif

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
            <div class="col-md-6 mt-2" wire:ignore>
                <div class="form-group">
                    <label class="form-label" for="user_id">User</label>
                    <select class="user" wire:model="user_id">
                        <option value="" selected>-- Pilih User --</option>
                        @foreach ($user as $users)

                        <option value="{{ $users->id }}">{{ $users->name }}</option>
                        @endforeach
                    </select>
                    @push('script')
                    <script>
                        new TomSelect(".user",{
                            create: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                        window.addEventListener("badak", ()=>{
                            console.log('badak');
                            $(".user").val("")

                        })
                    </script>
                    @endpush
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
            <div class="col-md-6 mt-2" wire:ignore>
                <div class="form-group">
                    <label class="form-label" for="divisi_id">Divisi</label>
                    <select class="divisi" wire:model="divisi_id">
                        <option value="" selected>-- Pilih Divisi --</option>
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
                    <div>
                        @error('divisi_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2" wire:ignore>
                <div class="form-group">
                    <label class="form-label" for="jenis_pekerjaan_id">Jenis Pekerjaan</label>
                    <select class="jenisP" wire:model="jenis_pekerjaan_id">
                        <option value="" selected>-- Pilih Jenis Pekerjaan --</option>
                        @foreach ($jenispekerjaan as $jenis_pekerjaans)

                        <option value="{{ $jenis_pekerjaans->id }}">{{ $jenis_pekerjaans->nama }}</option>
                        @endforeach
                    </select>
                    @push('script')
                    <script>
                        new TomSelect(".jenisP",{
                            create: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                    </script>
                    @endpush
                    <div>
                        @error('jenis_pekerjaan_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-2" wire:ignore>
                <div class="form-group">
                    <label class="form-label" for="jenis_pekerjaan_id">Lokasi</label>
                    <select class="lokasi" wire:model="lokasi_id">
                        <option value="" selected>-- Pilih Lokasi --</option>
                        @foreach ($lokasi as $lokasis)

                        <option value="{{ $lokasis->id }}">{{ $lokasis->nama }}</option>
                        @endforeach
                    </select>
                    @push('script')
                    <script>
                        new TomSelect(".lokasi",{
                            create: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                    </script>
                    @endpush
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
