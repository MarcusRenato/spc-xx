<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $data = $request->only([
            'email', 'password'
        ]);

        $remember = $request->input('remember', false);

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('login')
                    ->withErrors($validator)
                    ->withInput();
        }

        if (Auth::attempt($data, $remember)) {
            toast('Bem-vindo', 'success');
            return redirect()->route('home');
        } else {
            $validator->errors()->add('password', 'Email e/ou senha errados!');
            return redirect()->route('login')
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:4']
        ], [
            'required' => 'Preencha o campo',
            'string' => 'Preencha com caracteres válidos.',
            'email' => 'Digite um email válido',
            'min' => 'Senha muito curta.'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
