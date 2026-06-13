<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::query()
            //filter
            ->select('id', 'title', 'description', 'status','priority', 'slug','started_at','ended_at')
            ->when($request->filled('status'),fn($q) => $q->where('status',$request->status))
            ->when($request->filled('priority'),fn($q) => $q->where('priority',$request->priority))

            //search
            ->when($request->filled('search'),fn($q) => $q->where(function($q) use ($request){
                  $q->where('title','like','%'.$request->search.'%')
                      ->orWhere('description','like','%'.$request->search.'%');
            }))
            ->paginate($this->paginate);
        if ($tasks->isEmpty()) {
            return apiResponse(404, 'task not found');
        }
        return apiResponse(200, 'success', new TaskCollection($tasks));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();
        $task = Task::create($data);
        return apiResponse(201, 'Success', new TaskResource($task));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return apiResponse(200, 'success', new TaskResource($task));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return apiResponse(200, 'success', new TaskResource($task));
    }


    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        $task->update([
            'user_id' => $request->user_id
        ]);
        return apiResponse(200, 'success', new TaskResource($task));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return apiResponse(200, 'Task deleted');
    }
}


