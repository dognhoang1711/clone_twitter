<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\idea;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function add_comment(idea $idea)
    {
        $comment = new Comment();
        $comment->idea_id = $idea->id;
        $comment->user_id = auth()->id();
        $comment->content = request()->get('comment', '');
        $comment->save();
        return redirect()->route('dashboard',$idea->id)->with('sucess','comment thành công');
    }
    //
}
