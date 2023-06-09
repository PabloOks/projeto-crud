<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\StoreRoleRequest;
use App\Http\Requests\Api\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        return $this->success(data: [$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->description = $request->description ?? null;
        $role->save();

        return $this->success(
            message: 'Grupo criado com sucesso',
            data: ['id' => $role->id]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return $this->success(data: [$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->name = $request->name;
        $role->description = $request->description ?? null;
        $role->save();

        return $this->success(message: 'Dados alterados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return $this->success(message: 'Grupo excluído com sucesso');
    }
}
