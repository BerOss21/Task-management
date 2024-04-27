<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\States\Task\TaskCompleted;
use App\States\Task\TaskInProgress;
use App\Http\Controllers\Controller;

class StatisticController extends Controller
{
    public function __invoke(Request $request)
    {
        $total=Task::count();
        $completed=Task::whereState('status', TaskCompleted::class)->count();
        $in_progress=Task::whereState('status', TaskInProgress::class)->count();

        return compact('total',"completed",'in_progress');
    }
}
