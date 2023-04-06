<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use function view;

class ShowController extends Controller
{
    public function __invoke(Category $category)
    {
        return view('admin.category.show', ['category'=>$category]);
    }
}
