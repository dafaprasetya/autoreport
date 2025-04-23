<?php

namespace App\Livewire\Service;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormReportEksekutor extends Component
{
    #[Validate('required')]
    public $agenda, $kategori_harian_id, $user_id, $detail_kerja, $tanggal, $keterangan, $divisi_id, $lokasi_id, $jenis_pekerjaan_id;

    public $foto_before, $foto_after, $status, $tanggal_selesai;

    public function render()
    {
        $data = [
            'detail_kerja' => $this->detail_kerja,
            'tanggal' => $this->tanggal,
            'foto_before' => $this->foto_before,
            'foto_after' => $this->foto_after,
            'user_id' => $this->user_id,
        ];
        return view('livewire.service.form-report-eksekutor', $data);
    }
}
