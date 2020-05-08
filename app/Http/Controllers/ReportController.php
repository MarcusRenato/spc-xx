<?php

namespace App\Http\Controllers;

use App\Patrimony;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $input = $request->all();

        $data = ['patrimonies'];

        $patrimonies = Patrimony::orderBy('id', 'asc');

        if (isset($input['estado'])) {
            $patrimonies = $patrimonies->where('estado', $input['estado']);
        }

        if (isset($input['location_id'])) {
            $patrimonies = $patrimonies->where('location_id', $input['location_id']);
        }

        $patrimonies = $patrimonies->get();

        $pdf = PDF::loadView('report.index', compact($data));

        return $pdf->download('relatorio.pdf');
    }
}
