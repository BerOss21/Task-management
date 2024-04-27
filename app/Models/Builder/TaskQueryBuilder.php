<?php

namespace App\Models\Builder;

use Illuminate\Database\Eloquent\Builder;

class TaskQueryBuilder extends Builder
{
    const TASK_FIELDS=[
        'title'=>null,
        'status'=>null,
        'description'=>null,
        'due_date'=>null
    ];

    public function filter(?array $filters): self
    {
        $filters=array_merge(static::TASK_FIELDS,$filters??[]);

        return $this->when($filters['title'],function(Builder $query,$value){
            $query->where('title','ilike',"%$value%");
        })->when($filters['status'],function(Builder $query,$value){
            $query->where('status',$value);
        })->when($filters['due_date'],function(Builder $query,$value){
            $query->where('due_date',$value);
        });
    }

    public function sort(?array $sort) :self
    {
        $sort=array_merge(static::TASK_FIELDS,$sort??[]);

        return $this->when($sort['title'],function(Builder $query,$value){
            $query->orderBy('title',$value);
        })->when($sort['due_date'],function(Builder $query,$value){
            $query->orderBy('due_date',$value);
        },function (Builder $query) {
            $query->orderBy('created_at','desc');
        });
    }
}