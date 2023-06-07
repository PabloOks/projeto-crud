<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangeTaskStatusRequest;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Status;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task;
        $task->name = $request->name;
        $task->description = $request->description ?? null;
        $task->author = $request->author;
        $task->status = Status::NotStarted;
        $task->save();

        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description ?? null;
        $task->author = $request->author;
        $task->status = $request->status;
        $task->save();

        return response()->json([], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([], 200);
    }

    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        $task->status = $request->status;
        $task->save();

        return response()->json([], 200);
    }
}
