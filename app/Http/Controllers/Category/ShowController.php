<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use function compact;
use function dd;
use function view;

class ShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('category.show', compact('category'));
    }
}
