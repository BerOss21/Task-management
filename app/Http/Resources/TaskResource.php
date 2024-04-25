<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'description_preview'=>Str::limit($this->description,20),
            'due_date'=>$this->due_date->format('d/m/Y'),
            'status'=>[
                'name'=>$this->status,
                'color'=>$this->status->color()
            ],
            'user'=>new UserResource($this->whenLoaded('user'))
        ];
    }
}
