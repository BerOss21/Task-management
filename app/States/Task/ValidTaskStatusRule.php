<?php


namespace  App\States\Task;

use Spatie\ModelStates\Validation\ValidStateRule;

class ValidTaskStatusRule extends ValidStateRule
{
    public function message(): string
    {
        return "The status field's value is invalid";
    }
}