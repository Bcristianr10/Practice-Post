<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\{UserResource,CategoryResource};

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'slug'=>$this->slug,
            'extract'=>$this->extract,
            'body'=>$this->body,
            'status'=>$this->status == 1 ? 'PUBLICADO':'BORRADOR',
            'user'=>UserResource::make($this->whenLoaded('user')),
            'category'=>CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
