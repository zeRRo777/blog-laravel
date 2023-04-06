<?php

namespace App\Http\Controllers\Personal\Main;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function dd;
use function route;
use function view;


class IndexController extends Controller
{
    public function __invoke()
    {
        return view('personal.main.index');
    }
}
