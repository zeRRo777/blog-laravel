<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\Admin\Post\StoreRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use function abort;
use function redirect;
use function route;


class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $request->validated();
        $this->service->store($data);

        return redirect(route('admin.post.index'));
    }
}
