<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'token' => $this->createToken('API Token')->plainTextToken,
            'name'=>$this->name,
            'email'=>$this->email,
            'jabatan'=>$this->jabatan,
            'bagian'=>$this->bagian,
        ];
    }
}
