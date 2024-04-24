<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:sanctum')->group(function(){
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user',[AuthController::class,'user'])->name('user');
    Route::apiResource('tasks',TaskController::class,[
        'middleware'=>[
            'tasks.index'=>'can:viewAny,App\Models\Task',
            'tasks.show'=>'can:view,task',
            'tasks.store'=>'can:create,App\Models\Task',
            'tasks.update'=>'can:update,task',
            'tasks.destroy'=>'can:delete,task'
        ]
    ]);
});

