<?php

namespace App\Http\Resources;

use App\Models\ReportEksekutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportTeknisiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $report = ReportEksekutor::where('user_id', $this->id)->whereDate('tanggal', Carbon::parse(now()))->get();
        return [
            'report' => $report
        ];
    }
}
