<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use function redirect;
use function route;

class UpdateController extends BaseController
{
    public function __invoke(\App\Http\Requests\Admin\Post\UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post = $this->service->update($data, $post);

        return redirect(route('admin.post.show', ['post'=>$post]));
    }
}
