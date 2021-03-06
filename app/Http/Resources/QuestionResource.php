<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'replies' => ReplyResource::collection($this->replies),
            'replies_count' => $this->replies->count(),
            'created_at' => $this->created_at->diffForHumans(),
            'path' => $this->path,
            'user' => $this->user ? $this->user->name: null,
            'user_id' => $this->user_id
        ];
    }
}
