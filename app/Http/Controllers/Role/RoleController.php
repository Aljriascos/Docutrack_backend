<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_rol' => 'required',
            'descripcion' => 'nullable'
        ]);

        $role = Role::create($request->only('nombre_rol', 'descripcion'));
        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nombre_rol' => 'sometimes|required',
            'descripcion' => 'nullable'
        ]);

        $role->update($request->only('nombre_rol', 'descripcion'));
        return response()->json($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
