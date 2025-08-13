<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $method = $request->method();

        if($method == 'GET'){
           return Task::orderBy('created_at', 'asc')->get();
        }
        
        if($method == 'POST'){
            $this->validate($request, [
                'title' => 'required',
                'description' => 'required',
            ]);
            
            $task = new Task;
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status = $request->input('status');
            $task->save();
            
            return $task;
        }
    }
    

    /*public function create(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);
        
        $task = new Task;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->save();
        
        return $task;
    }
    
    public function show($id) {
        return Task::findOrFail($id);
    }*/
}
