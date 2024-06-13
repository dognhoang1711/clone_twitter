<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $ideas = $user->idea()->paginate(2);
        return view('user.show', compact('user', 'ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editting = true;
        $ideas = $user->idea()->paginate(2);
        return view('user.edit', compact('user', 'editting', 'ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Xóa file hình ảnh cũ nếu có (tùy chọn)
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Lưu file hình ảnh mới vào thư mục public/images
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        // Cập nhật thông tin người dùng
        $user->update($validated);

        return redirect()->route('users.show', $user->id)->with('success', 'Sửa thông tin profile thành công');
    }


    public function profile()
    {
        return $this->show(auth()->user());
    }
    /**
     * Remove the specified resource from storage.
     */
}
