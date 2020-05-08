@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Olá, {{ Auth::user()->name }}!
                </div>

                <div class="card-body">
                    Seja bem vindo ao sistema de controle de patrimônio do Campus XX da Universidade do Estado do Pará.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
