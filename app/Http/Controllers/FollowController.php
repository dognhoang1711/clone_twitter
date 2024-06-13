<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function follow(User $user)
    {
        $follower = auth()->user();
        $follower->following()->attach($user);
        return redirect()->route('users.show',$user->id)->with('sucess', 'đã theo dõi thành công');
    }
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        $follower->following()->detach($user);
        return redirect()->route('users.show',$user->id)->with('sucess', 'đã bỏ theo dõi thành công');
    }

}
