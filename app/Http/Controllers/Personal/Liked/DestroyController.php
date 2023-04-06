<?php

namespace App\Http\Controllers\Personal\Liked;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function route;

class DestroyController extends Controller
{
    public function __invoke(Post $post)
    {
        Auth::guard('web')->user()->likedPosts()->detach($post->id);
        return redirect(route('personal.liked.index'));
    }
}
