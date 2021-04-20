<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpdateNeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'need' => $this->need,
            'price' => $this->price,
            'day' => $this->day,
            'total' => $this->total,
            'note' => $this->note
        ];
    }
}
