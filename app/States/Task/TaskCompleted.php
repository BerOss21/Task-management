<?php

namespace App\States\Task;

class TaskCompleted extends TaskStatusState
{
    public static $name = 'completed';

    public function color(): string
    {
        return 'green';
    }
}


