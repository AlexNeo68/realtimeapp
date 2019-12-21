<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyResource extends JsonResource
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
            'user' => $this->user->name,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'likes' => $this->likes
        ];
    }
}
