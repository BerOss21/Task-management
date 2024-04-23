<?php

namespace App\Http\Requests\Task;

use Illuminate\Validation\Rule;
use App\States\Task\TaskStatusState;
use Illuminate\Database\Query\Builder;
use App\States\Task\ValidTaskStatusRule;
use Illuminate\Foundation\Http\FormRequest;
// use Spatie\ModelStates\Validation\ValidStateRule;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'=>[
                'required',
                'string',
                Rule::unique('tasks')
                    ->where(fn (Builder $query) => $query->where('user_id', auth()->id()))
            ],
            'description'=>['nullable','string'],
            'due_date'=>['required','after:now'],
            'status'=>new ValidTaskStatusRule(TaskStatusState::class)
        ];
    }
}
