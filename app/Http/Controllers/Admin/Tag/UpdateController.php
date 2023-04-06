<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use function dd;
use function redirect;
use function route;
use function view;

class UpdateController extends Controller
{
    public function __invoke(\App\Http\Requests\Admin\Tag\UpdateRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->title = $data['title'];
        $tag->save();
        return redirect(route('admin.tag.show', ['tag'=>$tag]));
    }
}
