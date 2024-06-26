<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks=Task::filter(request()->query('filters'))
                    ->sort(request()->query('sort'))
                    ->paginate(6)
                    ->withQueryString();

        return new TaskCollection($tasks);
    }

    public function store(CreateTaskRequest $request)
    {
        $task=Auth::user()->tasks()->create($request->validated());

        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return new TaskResource($task->fresh());
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response('',204);
    }
}
