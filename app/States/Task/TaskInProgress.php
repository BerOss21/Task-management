<?php

namespace  App\States\Task;


class TaskInProgress extends TaskStatusState
{
    public static $name = 'in_progress';
    
    public function color(): string
    {
        return 'orange';
    }
}


