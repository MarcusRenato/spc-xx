<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = ['locations'];

        $locations = Location::orderBy('description', 'asc')->paginate(25);
        return view('location.index', compact($data));
    }

    public function create()
    {
        return view('location.create');
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
            Location::create($data);

            toast('Localização cadastrada com sucesso', 'success');
            return redirect()->route('location.index');
        } catch (\Throwable $th) {

            toast('Ocorreu um erro ao tentar cadastrar a localização.', 'error');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Location $id)
    {
        $data = ['location'];

        $location = $id;

        return view('location.edit', compact($data));
    }

    public function update($id, Request $request)
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
            $local = Location::findOrFail($id);

            $local->update($data);

            toast('Dados de localização atualizados com sucesso', 'success');

            return redirect()->route('location.index');
        } catch (\Throwable $th) {
            Alert::error('Ocorreu um erro ao atualizar as informações');

            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $local = Location::findOrFail($id);

            $local->delete();

            toast('Localização excluída com sucesso', 'success');

            return redirect()->route('location.index');
        } catch (\Throwable $th) {
            toast('Ocorreu um erro ao tentar excluir a localização', 'error');

            return redirect()->back();
        }
    }
}
