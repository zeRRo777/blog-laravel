<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use function compact;
use function view;

class CreateController extends Controller
{
    public function __invoke()
    {
        $roles = User::getRoles();
        return view('admin.user.create', compact('roles'));
    }
}
