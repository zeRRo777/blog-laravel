<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function compact;
use function dd;
use function view;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Auth::guard('web')->user()->likedPosts;
        return view('personal.liked.index', compact('posts'));
    }
}
