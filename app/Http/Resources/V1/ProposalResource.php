<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "status"=>$this->status,
            "title"=> $this->title,
            "created"=>Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            "updated"=>Carbon::parse($this->updated_at)->format('Y-m-d H:i:s')
        ];
    }
}
