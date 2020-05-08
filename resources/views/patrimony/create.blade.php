@extends('layouts.template')

@section('content')


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pdf" role="tab" aria-controls="pdf" aria-selected="true">
            Cadastrar por PDF
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="manual" aria-selected="false">
            Cadastrar Manualmente
        </a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="pdf" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
            <div class="card-header h3 text-center">
                Cadastro de Patrimônio
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('patrimony.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="documento">Documento PDF</label>
                        <input type="file" name="documento" id="documento" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="manual" role="tabpanel" aria-labelledby="profile-tab">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="form-pdf" role="tabpanel" aria-labelledby="form-pdf-tab">
                <div class="card">
                    <div class="card-header h3 text-center">
                        Cadastro de Patrimônio
                    </div>

                    <div class="card-body">
                        <form action="{{ route('patrimony.store.manual') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="rp" class="text-right">RP: </label>
                                        <input type="text" name="rp" id="rp" class="form-control" value="{{ old('marca') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="marca">Marca: </label>
                                        <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="location_id">Localização: </label>
                                        <select name="location_id" id="location_id" class="form-control">
                                                <option value="">Selecione</option>
                                            @forelse ($location as $item)
                                                <option value="{{$item->id}}" {{ $item->id == old('location_id') ? 'selected="selected"' : '' }}>
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
                                        <textarea name="descricao" id="descricao" class="form-control" rows="5" required>{{ old('descricao') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="origin_id">Origem: </label>
                                        <select name="origin_id" id="origin_id" class="form-control">
                                            <option value="">Selecione</option>
                                            @foreach ($origins as $item)
                                                <option value="{{$item->id}}" {{ old('origin_id') == $item->id ? 'selected="selected"' : '' }}>{{$item->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="n_nf_tm">Nº da N. F./TM: </label>
                                        <input type="text" name="n_nf_tm" id="n_nf_tm" class="form-control" value="{{ old('n_nf_tm') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="prd">PRD: </label>
                                        <input type="text" name="prd" id="prd" class="form-control" value="{{ old('prd') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="processo">Processo: </label>
                                        <input type="text" name="processo" id="processo" class="form-control" value="{{ old('processo') }}">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="serie">Série: </label>
                                        <input type="text" class="form-control" name="serie" id="serie" value="{{ old('serie') }}">
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="data_emissao">Data de Emissão: </label>
                                        <input type="date" name="data_emissao" id="data_emissao" class="form-control" value="{{ old('data_emissao') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="data_entrada">Data de Entrada: </label>
                                        <input type="date" name="data_entrada" class="form-control" id="data_entrada"value="{{ old('data_entrada') }}">
                                    </div>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="tipo_origem">Tipo de Origem</label>
                                    <input class="form-control" type="text" name="tipo_origem" id="tipo_origem" value="{{ old('tipo_origem') }}" required>
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label for="situacao">Situação</label>
                                    <input class="form-control" type="text" name="situacao" id="situacao" value="{{ old('situacao') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="1" {{ old('estado') == '1' ? 'selected="selected"' : '' }}>
                                        Ativo
                                    </option>
                                    <option value="0" {{ old('estado') == '0' ? 'selected="selected"' : '' }}>
                                        Inservível
                                    </option>
                                </select>
                            </div>

                            <input type="submit" value="Cadastrar" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>

@endsection
