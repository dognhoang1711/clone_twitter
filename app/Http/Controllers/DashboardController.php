<?php

namespace App\Http\Controllers;

use App\Models\idea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $ideas = idea::with('user', 'comments.user')->orderBy('created_at', 'desc')->paginate(2);
        if (request()->has('content_search')) {
            $ideas = idea::search(request('content_search', ''))->paginate(3);
        }
        $topIdea = Cache::remember('top', 60, function () {
            return User::withCount('idea')->orderBy('created_at', 'desc')->limit(5)->get();
        });
        return view('dashboard', compact('ideas', 'topIdea'));
    }
}
