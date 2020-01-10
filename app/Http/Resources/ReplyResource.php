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
            'user' => $this->user ? $this->user->name : null,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'question_slug' => $this->question->slug,
            'created_at' => $this->created_at->diffForHumans(),
            'likes' => $this->likes,
            'likes_count' => $this->likes->count(),
            'liked' => $this->likes->where('user_id', auth()->id())->count(),

        ];
    }
}
