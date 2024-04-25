<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(auth()->user()->tasks()->get());
    }

    public function store(CreateTaskRequest $request)
    {
        $task=auth()->user()->tasks()->create($request->validated());

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if(count($request->validated())) $task->update($request->validated());

        return new TaskResource($task->fresh());
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response('',204);
    }
}
