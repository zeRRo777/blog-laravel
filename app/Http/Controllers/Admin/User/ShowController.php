<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use function view;

class ShowController extends Controller
{
    public function __invoke(User $user)
    {
        return view('admin.user.show', ['user'=>$user]);
    }
}
