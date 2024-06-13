<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function store(IdeaRequest $ideaRequest)
    {
        //store idea logic
        $vadidate = $ideaRequest->validated();
        $vadidate['user_id'] = auth()->id();
        idea::create($vadidate);
        return redirect()->route('dashboard')->with('sucess', 'thêm mới thành công 1 idea');
    }
    public function destroy(idea $idea)
    {
        // if (auth()->id() !== $idea->user_id) {
        //     return redirect()->route('dashboard')->with('sucess', 'bạn chỉ được xóa ý tưởng của mình');
        // }
        $this->authorize('delete', $idea);
        $idea->delete();
        return redirect()->route('dashboard')->with('sucess', 'đã xóa thành công');
    }
    //
    public function show(idea $idea)
    {
        return view('idea.show', compact('idea'));
    }
    public function edit(idea $idea)
    {
        $this->authorize('update', $idea);
        $editting = true;
        return view('idea.show', compact('idea', 'editting'));
    }
    public function update(idea $idea)
    {
        // if (auth()->id() !== $idea->user_id) {
        //     return redirect()->route('dashboard')->with('sucess', 'bạn chỉ có thể sửa ý tưởng của mình');
        //     }
        $this->authorize('update', $idea);
        request()->validate([
            'content' => 'required|max:100'
        ]);
        $idea->content = request()->get('content');
        $idea->save();
        return redirect()->route('dashboard')->with('sucess', 'đã sửa thành công 1 idea');
    }
}
