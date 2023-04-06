<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\User\PasswordMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use function dd;
use function event;
use function redirect;
use function route;
use function view;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::guard('web')->attempt($data))
        {
            if (Auth::user()->role === User::ROLE_ADMIN)
            {

                return redirect(route('admin.index'));
            }
            if (Auth::user()->role === User::ROLE_READER)
            {
                return redirect(route('index'));
            }
        }
        return redirect(route('login'))->withErrors(['password'=>'Пользователь не найден']);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = User::ROLE_READER;
        $user->password = Hash::make($data['password']);
        $user->save();
        Mail::to($user->email)->send(new PasswordMail($data['password']));
        Auth::guard('web')->login($user, 'true');
        event(new Registered($user));
        return redirect(route('index'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }

    public function forgot(ForgotRequest $request)
    {
        $data = $request->validated();
        $user = User::where(['email'=>$data['email']])->first();
        $password = uniqid('', true);
        $user->password = bcrypt($password);
        $user->save();
        Mail::to($user)->send(new PasswordMail($password));
        return redirect(route('login'));
    }

    public function showForgot()
    {
        return view('auth.forgot');
    }
}
