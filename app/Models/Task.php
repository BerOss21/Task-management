<?php

namespace App\Models;

use App\Models\Scopes\TaskScope;
use Spatie\ModelStates\HasStates;
use App\States\Task\TaskStatusState;
use Illuminate\Database\Eloquent\Model;
use App\Models\Builder\TaskQueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected static function booted(): void
    {
        static::addGlobalScope(new TaskScope);
    }

    public function newEloquentBuilder($query): TaskQueryBuilder
    {
        return new TaskQueryBuilder($query);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
