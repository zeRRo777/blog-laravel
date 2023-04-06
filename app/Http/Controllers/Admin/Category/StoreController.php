<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;
use function dd;
use function redirect;
use function route;
use function view;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $category = new Category;
        $category->title = $data['title'];
        $category->save();
        return redirect(route('admin.category.index'));
    }
}
