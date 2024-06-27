<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class User_Role_PermissionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:them tai khoan', ['only' => ['create', 'store']]);
        $this->middleware('permission:xoa tai khoan', ['only' => ['destroy']]);
        $this->middleware('permission:cap nhat tai khoan', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $user = User::all();
        return view('role.users.index', compact('user'));
    }
    public function create()
    {
        $role = Role::pluck('name')->all();
        return view('role.users.create', compact('role'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->syncRoles($request->roles);
        return redirect()->route('user.index');
    }
    public function edit(User $user)
    {
        $role = Role::pluck('name')->all();
        $roleUser = $user->roles->pluck('name')->all();
        return view('role.users.update', compact('user', 'role', 'roleUser'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'roles' => 'required'
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->syncRoles($request->roles);
        return redirect()->route('user.index');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();
        return redirect()->route('user.index');
    }
}
