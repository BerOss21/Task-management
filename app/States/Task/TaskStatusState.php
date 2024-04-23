<?php

namespace  App\States\Task;

use Spatie\ModelStates\State;

abstract class TaskStatusState extends State
{
    abstract public function color(): string;
}