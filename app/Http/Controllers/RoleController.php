<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('permission:them role', ['only' => ['create', 'store']]);
        $this->middleware('permission:xoa role', ['only' => ['destroy']]);
        $this->middleware('permission:sua role', ['only' => ['edit']]);
    }
    public function index()
    {
        $role = Role::all();
        return view('role.roles.index', compact('role'));
    }
    public function create()
    {
        return view('role.roles.create');
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]

        ]);
        $role->update([
            'name' => $request->name
        ]);
        return redirect('role')->with('status', 'sửa chuc vu thành công');
    }
    public function edit(Role $role)
    {

        return view('role.roles.update', compact('role'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]

        ]);
        Role::create([
            'name' => $request->name
        ]);
        return redirect('role')->with('status', "thêm chuc vu thành công");
    }
    public function destroy($id)
    {
        Role::findById($id)->delete();
        return redirect('role')->with('status', "xoa chuc vu thành công");
    }
    public function add_permission($id)
    {
        $permission = Permission::get();
        $role = Role::findById($id);
        $role_permission = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id')->all();
        return view('role.roles.add_permission_to_role', compact('role', 'permission', 'role_permission'));

    }
    public function givepermission_to_Role(Request $request, $role_Id)
    {
        $request->validate([
            'permission' => "required"
        ]);
        $role = Role::findById($role_Id);
        $role->syncPermissions($request->permission);
        return redirect()->back()->with('status', 'đã thêm quyền thành công');
    }
}
