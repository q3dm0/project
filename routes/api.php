<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'guest:web'], function(){
    Route::match(['get', 'post', 'put', 'delete'], 'tasks', [TaskController::class, 'index']);
});

Route::get('/tasks/{id}', function (string $id) {
    return Task::findOrFail($id);  
})->where('id', '[0-9]+');

Route::put('/tasks/{id}', function (Request $request, string $id) {
    $task = Task::findOrFail($id);
    $task->title = $request->input('title');
    $task->description = $request->input('description');
    $task->save();

    return $task;
})->where('id', '[0-9]+');

Route::delete('/tasks/{id}', function (Request $request, string $id) {
    $task = Task::findOrFail($id);
    if ($task->delete()) {
        return 'deleted successfully';
    }
})->where('id', '[0-9]+');