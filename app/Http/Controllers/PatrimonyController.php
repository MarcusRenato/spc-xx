<?php

namespace App\Http\Controllers;

use App\Location;
use App\Origin;
use App\Patrimony;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Smalot\PdfParser\Parser;

class PatrimonyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data = ['patrimonies', 'locations', 'input'];

        $input = $request->all();

        $locations = Location::all();
        $patrimonies = Patrimony::orderBy('rp', 'asc');

        if (isset($input['localizacao'])) {
            $patrimonies = $patrimonies->where('location_id', $input['localizacao']);
        }

        if (isset($input['rp'])) {
            $patrimonies = $patrimonies->where('rp', 'like', '%' . $input['rp'] . '%');
        }

        if (isset($input['descricao'])) {
            $patrimonies = $patrimonies->where('descricao', 'like', '%' . $input['descricao'] . '%');
        }

        $patrimonies = $patrimonies->paginate(25);

        return view('patrimony.index', compact($data));
    }

    public function create()
    {
        $data['location'] = Location::all();
        $data['origins'] = Origin::all();

        return view('patrimony.create')->with($data);
    }

    public function showFormReport(Request $request)
    {
        $data = ['locations'];

        $locations = Location::all();

        return view('patrimony.formreport', compact($data));
    }

    public function store(Request $request)
    {
        $parser = new Parser();
        $patrimony = new Patrimony();

        if ($request->hasFile('documento')) {
            $document = $request->file('documento');

            $upload = $document->store('documents');

            if (!$upload) {
                toast('Ocorreu um erro ao fazer o upload.', 'error');
                return redirect()->back()->withInput();
            }

            $upload = 'storage/' . $upload;

            $pdf = $parser->parseFile(public_path($upload));

            $dataArray = $pdf->getText();
            $dataArray = explode("\n", $dataArray);

            for ($i = 0; $i < count($dataArray); $i++) {
                $dataAux[] = explode("	", $dataArray[$i]);
            }

            for ($i = 0; $i < count($dataAux); $i++) {
                if (sizeof($dataAux[$i]) > 5) {
                    array_shift($dataAux[$i]);
                    array_pop($dataAux[$i]);
                    $arrayPre[] = $dataAux[$i];
                }
            }

            foreach($arrayPre as $array) {
                $dataFinal[] = [
                    'rp' => $array['0'],
                    'descricao' => $array['1'],
                    'tipo_origem' => $array['2'],
                    'situacao' => $array['3']
                ];
            }

            if (count($dataFinal) && !empty($dataFinal)) {

                foreach ($dataFinal as $data) {
                    try {
                        $patrimony->create($data);

                    } catch (\Throwable $th) {
                        $errors[] = $data['rp'];
                    }
                }

                if ($patrimony) {
                    toast('Dados inseridos com sucesso', 'success');
                    return redirect()->back();
                }
            }
        }

    }

    public function storeManual(Request $request)
    {
        $input = $request->all();

        try {
            Patrimony::create($input);

            toast('Patrimonio inserido com sucesso!', 'success');
            return redirect()->route('patrimony.index');
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function report(Request $request)
    {
        $data = ['patrimonies', 'input'];

        $patrimonies = Patrimony::orderBy('id', 'asc');

        $input = $request->all();

        if (isset($input['estado'])) {
            $patrimonies = $patrimonies->where('estado', $input['estado']);
        }

        if (isset($input['location_id'])) {
            $patrimonies = $patrimonies->where('location_id', $input['location_id']);
        }

        $patrimonies = $patrimonies->paginate(25);

        return view('patrimony.report', compact($data));
    }


    public function edit(Patrimony $id)
    {
        $data = ['patrimony', 'location', 'origins'];

        $location = Location::all();
        $origins = Origin::all();

        $patrimony = $id;

        return view('patrimony.edit', compact($data));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $patrimony = Patrimony::find($id);

        try {
            $patrimony->update($input);

            toast('Informações do patrimônio atualizadas com sucess', 'success');

            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Ocorreu um erro');
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $patrimony = Patrimony::findOrFail($id);

            $patrimony->delete();

            toast('Patrimonio excluído com sucesso', 'success');

            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Ocorreu um erro ao excluir', 'error');
            return redirect()->back();
        }
    }


}
