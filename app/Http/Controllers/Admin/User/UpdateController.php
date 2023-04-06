<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\User;
use function dd;
use function redirect;
use function route;
use function view;

class UpdateController extends Controller
{
    public function __invoke(\App\Http\Requests\Admin\User\UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect(route('admin.user.show', ['user'=>$user]));
    }
}
