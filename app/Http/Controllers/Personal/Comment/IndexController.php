<?php

namespace App\Http\Controllers\Personal\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function compact;
use function view;

class IndexController extends Controller
{
    public function __invoke()
    {
        $comments = Auth::guard('web')->user()->comments;
        return view('personal.comment.index', compact('comments'));
    }
}
