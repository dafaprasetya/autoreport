<?php

namespace App\Http\Resources;

use App\Models\ReportHarianIt;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ReportHarianService;

use Carbon\Carbon;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->bagian == 'Service'){
            $pointoday = ReportHarianService::where('user_id', $this->id)->whereDate('date', Carbon::now())
                            ->selectRaw('SUM(poin) as total_poin')
                            ->get();
            $poinbulan = ReportHarianService::where('user_id', $this->id)->whereMonth('date', Carbon::now())
                            ->selectRaw('SUM(poin) as total_poin')
                            ->get();
        }else if($this->bagian == "IT"){
            $pointoday = ReportHarianIt::where('user_id', $this->id)->whereDate('date', Carbon::now())
                        ->selectRaw('SUM(poin) as total_poin')
                        ->get();
            $poinbulan = ReportHarianIt::where('user_id', $this->id)->whereMonth('date', Carbon::now())
                        ->selectRaw('SUM(poin) as total_poin')
                        ->get();
        }
        return [
            'success' => true,
            'token' => $this->createToken('API Token')->plainTextToken,
            'name'=>$this->name,
            'pointoday'=>$pointoday,
            'poinbulan'=>$poinbulan,
            'id'=>$this->id,
            'email'=>$this->email,
            'picture'=>$this->picture,
            'jabatan'=>$this->jabatan,
            'bagian'=>$this->bagian,
        ];
    }
}
