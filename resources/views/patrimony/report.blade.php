@extends('layouts.template')

@section('content')
    <div class="row justify-content-end my-4">
        <form action="{{ route('patrimony.report.pdf') }}" method="get">
            @csrf
            <input type="hidden" name="location_id" value="{{ $input['location_id'] ?? '' }}">

            <input type="hidden" name="estado" value="{{ $input['estado'] ?? '' }}">


            <button type="submit" class="btn btn-info mx-4">
                Gerar PDF
            </button>
        </form>

        <a href="{{ route('patrimony.form.relatorio') }}" class="btn btn-secondary">
            Fazer Nova Consulta
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center">
            <thead>
                <th>RP</th>
                <th>Descrição</th>
                <th>Estado</th>
                <th>Localização</th>
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
                        {{ $item->localizacao->description ?? '' }}
                    </td>
                </tbody>
            @empty

            @endforelse
        </table>
        {{ $patrimonies->appends([
            'estado' => $input['estado'] ?? '',
            'location_id' => $input['location_id'] ?? ''
        ])->links() }}
    </div>
@endsection
