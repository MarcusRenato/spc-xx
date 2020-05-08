@extends('layouts.template')

@section('content')

<form method="GET" action="{{ route("patrimony.report") }}">

    <div class="form-row">
        <div class="col-sm-6 form-group">
            <label for="estado">
                Estado
            </label>
            <select name="estado" class="form-control" id="estado">
                <option value="">Selecione</option>
                <option value="1">Ativo</option>
                <option value="0">Insercivel</option>

            </select>
        </div>

        <div class="col-sm-6 form-group">
            <label for="location_id">
                Localização
            </label>
            <select name="location_id" id="location_id" class="form-control">
                <option value="">Selecione</option>
                @forelse ($locations as $item)
                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                @empty

                @endforelse
            </select>
        </div>
    </div>
    <div class="form-group">

    </div>
    <div class="row justify-content-center">
        <button class="btn btn-primary">Gerar Relatório</button>
    </div>
</form>
@endsection
