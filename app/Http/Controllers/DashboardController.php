<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $ideas = idea::with('user','comments.user')->orderBy('created_at', 'desc')->paginate(2);
        if (request()->has('content_search')) {
            $ideas = idea::where('content', 'like', '%' . request()->get('content_search', '') . '%')->paginate(3);
        }
        return view('dashboard', compact('ideas'));
    }
}
