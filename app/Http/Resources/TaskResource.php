<?php

namespace App\Http\Resources;

use App\Models\Task;
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
            'due_date'=>[
                'dmy'=>$this->due_date->format('d-m-Y'),
                'ymd'=>$this->due_date->format('Y-m-d')
            ],
            'status'=>[
                'name'=>$this->status,
                'states'=>Task::getStatesFor('status')
            ],
            'user'=>new UserResource($this->whenLoaded('user'))
        ];
    }
}
