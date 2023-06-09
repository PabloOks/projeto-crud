<?php

namespace App\Http\Controllers\Api;

use App\Enums\ResponseStatusCode;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\ChangeTaskStatusRequest;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Enums\Status;
use App\Http\Requests\Api\DelegateMembersRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::with('delegatedUsers')
            ->where('author', '=', $request->user()->id)
            ->get();

        return $this->success(data: [$tasks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task;
        $task->name = $request->name;
        $task->description = $request->description ?? null;
        $task->author = $request->user()->id;
        $task->status = Status::NotStarted;
        $task->save();

        return $this->success(
            message: 'Tarefa criada com sucesso',
            data: ['id' => $task->id]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return $this->success(data: [$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description ?? null;
        $task->save();

        return $this->success(message: 'Dados alterados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return $this->success(message: 'Tarefa excluída com sucesso');
    }

    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        $task->status = $request->status;
        $task->save();

        return $this->success(message: 'Status alterado com sucesso');
    }

    public function delegateMembers(DelegateMembersRequest $request, Task $task)
    {
        if ($task->author != $request->user()->id) return $this->error(
            code: ResponseStatusCode::Unauthorized,
            message: 'Você não possui permissão'
        );

        $users = collect($request->users)
            ->filter(function (int $val) use ($request) {
                return $val != $request->user()->id;
            });

        $task->delegatedUsers()->sync($users);

        return $this->success(message: 'Tarefa atribuída aos usuários com sucesso');
    }
}
