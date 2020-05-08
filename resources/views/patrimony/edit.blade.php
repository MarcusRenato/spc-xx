@extends('layouts.template')

@section('content')
    <div class="row justify-content-end my-4">
        <a href="{{ route('patrimony.index') }}" class="btn btn-secondary">
            Voltar a lista de patrimônios
        </a>
    </div>
    <div class="card mb-5">
        <div class="card-header h3 text-center">
            Editar informações
        </div>

        <div class="card-body">
            <form action="{{ route('patrimony.update', ['id' => $patrimony->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="rp" class="text-right">RP: </label>
                            <input type="text" name="rp" id="rp" class="form-control" value="{{ $patrimony->rp ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="marca">Marca: </label>
                            <input type="text" name="marca" id="marca" class="form-control" value="{{ $patrimony->marca ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="location_id">Localização: </label>
                            <select name="location_id" id="location_id" class="form-control">
                                    <option value="">Selecione</option>
                                @forelse ($location as $item)
                                    <option value="{{$item->id}}" {{ $item->id == $patrimony->location_id ? 'selected="selected"' : '' }}>
                                        {{$item->description}}
                                    </option>
                                @empty
                                    <option value="">Nenhum local cadastrado</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="descricao">Descrição: </label>
                            <textarea name="descricao" id="descricao" class="form-control" rows="5" required>{{ $patrimony->descricao ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="origin_id">Origem: </label>
                            <select name="origin_id" id="origin_id" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($origins as $item)
                                    <option value="{{$item->id}}" {{ $patrimony->origin_id == $item->id ? 'selected="selected"' : '' }}>{{$item->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="n_nf_tm">Nº da N. F./TM: </label>
                            <input type="text" name="n_nf_tm" id="n_nf_tm" class="form-control" value="{{ $patrimony->n_nf_tm ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="prd">PRD: </label>
                            <input type="text" name="prd" id="prd" class="form-control" value="{{ $patrimony->prd ?? ''}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="processo">Processo: </label>
                            <input type="text" name="processo" id="processo" class="form-control" value="{{ $patrimony->processo ?? '' }}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="serie">Série: </label>
                            <input type="text" class="form-control" name="serie" id="serie" value="{{ $patrimony->serie ?? '' }}">
                        </div>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="data_emissao">Data de Emissão: </label>
                            <input type="date" name="data_emissao" id="data_emissao" class="form-control" value="{{ $patrimony->data_emissao ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="data_entrada">Data de Entrada: </label>
                            <input type="date" name="data_entrada" class="form-control" id="data_entrada"value="{{ $patrimony->data_entrada ?? '' }}">
                        </div>
                    </div>

                    <div class="col-sm-3 form-group">
                        <label for="tipo_origem">Tipo de Origem</label>
                        <input class="form-control" type="text" name="tipo_origem" id="tipo_origem" value="{{ $patrimony->tipo_origem ?? '' }}">
                    </div>

                    <div class="col-sm-3 form-group">
                        <label for="situacao">Situação</label>
                        <input class="form-control" type="text" name="situacao" id="situacao" value="{{ $patrimony->situacao ?? '' }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="">Selecione</option>
                        <option value="1" {{ $patrimony->estado == '1' ? 'selected="selected"' : '' }}>
                            Ativo
                        </option>
                        <option value="0" {{ $patrimony->estado == '0' ? 'selected="selected"' : '' }}>
                            Inservível
                        </option>
                    </select>
                </div>

                <input type="submit" value="Atualizar" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
