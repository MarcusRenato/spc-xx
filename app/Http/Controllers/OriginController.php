<?php

namespace App\Http\Controllers;

use App\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class OriginController extends Controller
{
    private $origin;

    public function __construct(Origin $origin)
    {
        $this->origin = $origin;
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['origins'];
        $origins = $this->origin->orderBy('description', 'asc')->paginate(25);

        return view('origin.index', compact($data));
    }

    public function create()
    {
        return view('origin.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('description');

        $validator = Validator::make($data, [
            'description' => 'required|string'
        ], [
            'required' => 'Preencha este campo.',
            'string' => 'Preencha o campo com caracteres válidos.'
        ]);

        if ($validator->fails()) {
            Alert::warning('Preencha o campo.');
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $this->origin->create($data);

            toast('Origem cadastrada com sucesso', 'success');
            return redirect()->route('origem.index');
        } catch (\Throwable $th) {

            toast('Ocorreu um erro ao tentar cadastrar a origem.' .  $th->getMessage(), 'error');
            return redirect()->back()->withInput();
        }
    }


    public function edit($id)
    {
        $data = ['origin'];

        $origin = $this->origin->findOrFail($id);

        return view('origin.edit', compact($data));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('description');

        $validator = Validator::make($data, [
            'description' => 'required|string'
        ], [
            'required' => 'Preencha este campo.',
            'string' => 'Preencha o campo com caracteres válidos.'
        ]);

        if ($validator->fails()) {
            Alert::warning('Preencha o campo.');
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {
            $origin = $this->origin->findOrFail($id);

            $origin->update($data);

            toast('Dados de origem atualizados com sucesso', 'success');

            return redirect()->route('origem.index');
        } catch (\Throwable $th) {
            Alert::error('Ocorreu um erro ao atualizar as informações');

            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $origin = $this->origin->findOrFail($id);

            $origin->delete();

            toast('Origem excluída com sucesso', 'success');

            return redirect()->route('origem.index');
        } catch (\Throwable $th) {
            toast('Ocorreu um erro ao tentar excluir a origem.', 'error');

            return redirect()->back();
        }
    }
}
