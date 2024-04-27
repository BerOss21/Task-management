<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::middleware('guest:sanctum')->group(function(){
    Route::post('login',[AuthController::class,'login'])->name('login');
    Route::post('register',[AuthController::class,'register'])->name('register');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user',[AuthController::class,'user'])->name('user');
   
    Route::get('tokens',[AuthController::class,'tokens'])->name('tokens');
    Route::post('tokens',[AuthController::class,'generateToken']);
   
    Route::get('tasks', [TaskController::class, 'index'])
        ->name('tasks.index')
        ->middleware(['can:viewAny,App\Models\Task',HandlePrecognitiveRequests::class]);

    Route::post('tasks', [TaskController::class, 'store'])
        ->name('tasks.store')
        ->middleware('can:create,App\Models\Task');
    
    Route::get('tasks/{task}', [TaskController::class, 'show'])
        ->name('tasks.show')
        ->middleware('can:view,task');
    
    Route::match(['patch','put'],'tasks/{task}', [TaskController::class, 'update'])
        ->name('tasks.update')
        ->middleware('can:update,task');

    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy')
        ->middleware('can:delete,task');
    
});

