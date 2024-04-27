<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use App\States\Task\TaskCompleted;
use App\States\Task\TaskInProgress;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
 
    /**
     * Get additional data that should be returned with the resource array.
     *
     * @return array<string, mixed>
     */
    public function with(Request $request): array
    {
        return [
            'statistics'=>[
                'total'=>Task::count(),
                'completed'=>Task::whereState('status', TaskCompleted::class)->count(),
                'in_progress'=>Task::whereState('status', TaskInProgress::class)->count()
            ]
        ];
    }


}
