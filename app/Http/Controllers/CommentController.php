<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(CommentRequest $request, idea $idea)
    {
        $validatedData = $request->validated();
        $validatedData['idea_id'] = $idea->id;
        $validatedData['user_id'] = auth()->id();
        Comment::create($validatedData);
        return redirect()->route('dashboard', $idea->id)->with('sucess', 'comment thành công');
    }
    //
}
