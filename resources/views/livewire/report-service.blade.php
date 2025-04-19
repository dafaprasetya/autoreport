<div>

    <div class="table-responsive">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>

                    <th scope="col">No.</th>
                    <th scope="col">Tanggal Keluhan</th>
                    <th scope="col">Keterangan</th>
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
                <tr>
                    <td>
                    <div class="form-check style-check d-flex align-items-center">
                        <label class="form-check-label">
                            {{ $reports->id }}
                        </label>
                    </div>
                    </td>
                    <td><a href="#{{ $reports->tanggal }}" class="text-primary-600">{{ $reports->tanggal }}</a></td>
                    <td>
                        <select class="form-select" id="kategori{{ $reports->id }}">
                            <option selected>{{ $reports->keterangan }}</option>
                            <option value="Internal">Internal</option>
                            <option value="Ekternal">Ekternal</option>
                        </select>
                    </td>
                    <td>
                        <textarea class="form-control" name="deskripsi_pekerjaan" id="deskripsi_pekerjaan{{ $reports->id }}" cols="30" rows="3">{{ $reports->deskripsi_pekerjaan }}</textarea>
                    </td>
                    <td>
                        <select class="form-select" id="divisi{{ $reports->id }}" class="divisi">
                            <option selected>{{ $reports->divisi->nama }}</option>
                            @foreach ($divisi as $divisis)
                                <option value="{{ $divisis->id }}">{{ $divisis->nama }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{ $reports->jenis_pekerjaan->nama }}</td>
                    <td>{{ $reports->lokasi->nama }}</td>
                    <td>{{ $reports->foto_before }}</td>
                    <td>{{ $reports->foto_after }}</td>
                    <td>{{ $reports->tanggal_selesai }}</td>
                    <td>{{ $reports->lead_time }}</td>
                    <td>
                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                    </a>
                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="lucide:edit"></iconify-icon>
                    </a>
                    <a href="javascript:void(0)" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                    </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $report->links() }}
    </div>
</div>
