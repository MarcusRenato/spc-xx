@extends('layouts.template')

@section('content')
<form method="GET">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-center h3">
                    Busca
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="localizacaoBusca">Localização: </label>
                        <select name="localizacao" class="form-control" id="localizacaoBusca">
                            <option value="">
                                Selecione
                            </option>
                            @foreach ($locations as $item)
                                <option value="{{ $item->id }}" {{ isset($input['localizacao']) && $input['localizacao'] == $item->id ? 'selected="selected"' : '' }}>
                                    {{$item->description}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-4 form-group">
                            <label for="rp">RP</label>
                            <input value="{{ $input['rp'] ?? '' }}" type="text" name="rp" class="form-control" id="rp">
                        </div>
                        <div class="col-sm-8 form-group">
                            <label for="descricao">Descrição</label>
                            <input type="text" name="descricao" id="descricao" value="{{ $input['descricao'] ?? '' }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class="row justify-content-end">
        <a href="{{ route('patrimony.form') }}" class="btn btn-success my-4">Cadastrar Novo</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center">
            <thead>
                <th>RP</th>
                <th>Descrição</th>
                <th>Estado</th>
                <th>Localização</th>
                <th>Opções</th>
            </thead>

            @forelse ($patrimonies as $item)
                <tbody>
                    <td>
                        {{ $item->rp ?? 'S/RP' }}
                    </td>

                    <td>
                        {{ $item->descricao ?? '' }}
                    </td>

                    <td>
                        @if (isset($item->estado))
                            {{ $item->estado == 1 ? 'Ativo' : 'Inservível' }}
                        @else
                            Não cadastrado
                        @endif
                    </td>

                    <td>
                        {{ $item->localizacao->description ?? 'Não Cadastrado' }}
                    </td>

                    <td>
                        <a class="btn btn-primary" href="{{ route('patrimony.edit', ['id' => $item->id]) }}">
                            Editar
                        </a>

                        <form class="d-inline" action="{{route('patrimony.destroy', ['id' => $item->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Excluir" class="btn btn-danger">
                        </form>
                    </td>
                    </td>
                </tbody>
            @empty

            @endforelse
        </table>
        {{ $patrimonies->appends([
            'localizacao' => $input['localizacao'] ?? '',
            'rp' => $input['rp'] ?? '',
            'descricao' => $input['descricao'] ?? ''
        ])->links() }}
    </div>
@endsection
