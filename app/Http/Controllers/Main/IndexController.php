<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use function redirect;
use function route;

class IndexController extends Controller
{
    public function __invoke()
    {
        return redirect(route('post.index'));
    }
}
