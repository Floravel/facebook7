<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ([
            'data' => [
                'type' => 'posts',
                'post_id' => $this->id,
                'attributes' => [
                    'title' => $this->title,
                    'posted_by' => new UserResource($this->user),
                    'body' => $this->body,
                    'image' => $this->image,
                    'posted_at' => $this->created_at->DiffForHumans(),
                ]
            ],
            'links' => [
                'self' => url('/posts/'.$this->id),
            ]
        ]);
    }
}
