<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    //

    public function index()
    {
        $idea = idea::latest()->paginate();
        return view('admin.ideas.index', compact('idea'));
    }
}
