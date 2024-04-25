<?php

namespace App\Models;

use Spatie\ModelStates\HasStates;
use App\States\Task\TaskStatusState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Task extends Model
{
    use HasFactory, HasStates, HasUuids;

    protected $fillable=['title','description','due_date','status'];

    protected function casts(): array
    {
        return [
            'status' => TaskStatusState::class,
            'due_date'=>'datetime'
        ];
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
