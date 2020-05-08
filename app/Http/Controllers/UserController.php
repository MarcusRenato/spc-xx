<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $data = ['users', 'loggedId'];
        $loggedId = auth()->id();

        $this->authorize('super');

        $users = $this->user->all();

        return view('admin.index', compact($data));
    }

    public function create()
    {
        $this->authorize('super');
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->authorize('super');
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
            'function' => 'required|string'
        ], [
            'required' => 'Preencha este campo',
            'email' => 'Digite um email válido.',
            'min' => 'Digite uma senha com mais de 4 caracteres.',
            'confirmed' => 'As senhas não correspondem'
        ]);

        if ($validator->fails()) {
            Alert::warning('Preencha os campos corretamente');

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data['password'] = Hash::make($data['password']);

        try {
            $this->user->name = $data['name'];
            $this->user->email = $data['email'];
            $this->user->password = $data['password'];
            $this->user->function = $data['function'];

            $this->user->save();

            toast('Usuário inserido com sucesso!', 'success');

            return redirect()->route('adminindex');
        } catch (\Throwable $th) {
            toast('Ocorreu um erro ao inserir usuário!');

            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $this->authorize('super');
        $data = ['user'];

        $user = $this->user->find($id);

        return view('admin.edit', compact($data));
    }

    public function update($id, Request $request)
    {
        $this->authorize('super');
        $data = $request->all();

        $user = $this->user->find($id);

        if ($data['password'] == null || $data['password_confirmation'] == null) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        if (isset($data['password']) || isset($data['password_confirmation'])) {
            if ($data['password'] === $data['password_confirmation']) {

                if (strlen($data['password']) <= 4) {
                    Alert::error('Verifique os campos digitados');
                    return redirect()
                                ->back()
                                ->withErrors(['password' => 'Digite uma senha com mais de 4 caracteres.'])
                                ->withInput();
                }

                $data['password'] = Hash::make($data['password']);
            } else {
                Alert::error('Verifique os campos digitados');
                return redirect()->back()->withErrors(['password' => 'As senhas não correspondem'])->withInput();
            }
        }

        try {
            $user->update($data);

            toast('Usuário atualizado com sucesso', 'success');
            return redirect()->route('adminindex');
        } catch (\Throwable $th) {
            toast('Ocorreu um erro' . $th->getMessage(), 'error');
            return redirect()->back()->withInput();
        }

    }

    public function destroy($id)
    {
        $this->authorize('super');
        $user = $this->user->find($id);

        try {
            $user->delete();

            toast('Usuário excluído com sucesso', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Ocorreu um erro', 'error');
            return redirect()->back();
        }
    }

    public function logout()
    {
        dd("aqui");
        Auth::logout();

        toast('Você saiu do sistemas', 'success');
        return redirect()->route('home');
    }
}
