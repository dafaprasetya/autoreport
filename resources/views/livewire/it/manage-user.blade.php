<div class="card">
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
    <div class="card-body" wire:poll>
        <div class="table-responsive">
            <table class="table bordered-table mb-0">
                <thead>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $users)
                        <tr>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->email }}</td>
                            <td>
                                <select wire:blur="updateCell({{ $users->id }}, 'bagian', $event.target.value)" name="bagian" class="form-select" id="bagian{{ $users->id }}">
                                    <option value="{{ $users->bagian }}">{{ $users->bagian }}</option>
                                    <option value="IT">IT</option>
                                    <option value="Service">Service</option>
                                </select>
                            </td>
                            <td>
                                <select wire:blur="updateCell({{ $users->id }}, 'jabatan', $event.target.value)" name="jabatan" class="form-select" id="jabatan{{ $users->id }}">
                                    <option value="{{ $users->jabatan }}">{{ $users->jabatan }}</option>
                                    <option value="Manager">Manager</option>
                                    <option value="SPV">SPV</option>
                                    <option value="PIC">PIC</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Eksekutor">Eksekutor</option>
                                </select>
                            </td>
                            <td>
                                <input type="password" name="" id="" wire:blur="updateCell({{ $users->id }}, 'password', $event.target.value)">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
