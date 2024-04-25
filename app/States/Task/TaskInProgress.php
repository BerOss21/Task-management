<?php

namespace  App\States\Task;


class TaskInProgress extends TaskStatusState
{
    public static $name = 'in progress';
    
    public function color(): string
    {
        return 'orange';
    }
}


