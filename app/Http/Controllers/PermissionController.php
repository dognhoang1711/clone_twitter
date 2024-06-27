<?php

namespace App\Http\Controllers;

use App\Models\Permisstion;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{



    public function __construct()
    {
        $this->middleware('permission:them quyền', ['only' => ['create', 'store']]);
        $this->middleware('permission:sửa quyền', ['only' => ['edit', 'update']]);
        $this->middleware('permission:xóa quyền', ['only' => ['destroy']]);
    }
    public function index()
    {
        $permission = Permission::all();
        return view('role.permission.index', compact('permission'));
    }
    public function create()
    {
        return view('role.permission.create');
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]

        ]);
        $permission->update([
            'name' => $request->name
        ]);
        return redirect('permission')->with('status', 'sửa quyền thành công');
    }
    public function edit(Permission $permission)
    {

        return view('role.permission.update', compact('permission'));
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
        Permission::create([
            'name' => $request->name
        ]);
        return redirect('permission')->with('status', "thêm quyền thành công");
    }
    public function destroy($id)
    {
        Permission::findById($id)->delete();
        return redirect('permission')->with('status', "xoa quyền thành công");
    }
}
