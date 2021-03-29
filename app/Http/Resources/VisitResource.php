<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'user_id' => $this->user_id,
            'slug' => $this->slug,
            'request' => $this->request,
            'result' => $this->result,
            'is_visited' => $this->is_visited,
            'published' => $this->created_at->format('d F, Y')
        ];
    }
}
