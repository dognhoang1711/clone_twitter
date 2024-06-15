<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    //

    public function load()
    {
        $dataUser = User::latest()->paginate();
        return view('admin.authorize.index', compact('dataUser'));
    }
    public function AddAuthor(Request $request)
    {
        $isAdminData = $request->input('is_admin', []);

        foreach ($isAdminData as $userId => $isAdmin) {
            $user = User::find($userId);
            if ($user) {
                $user->is_admin = filter_var($isAdmin, FILTER_VALIDATE_BOOLEAN);
                $user->save();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Đã cập nhật quyền thành công cho');
    }
}
