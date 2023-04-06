<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use function compact;
use function dd;
use function view;

class IndexController extends Controller
{
    public function __invoke()
    {

        $categories = Category::all();

        return view('category.index', compact( 'categories'));
    }
}
