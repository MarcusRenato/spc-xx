@extends('layouts.template')

@section('content')
    <div class="row justify-content-end my-4">
        {{-- <div class="col-sm-3"> --}}
            <a href="{{ route('location.create') }}" class="btn btn-success">
                Cadastrar Novo
            </a>
        {{-- </div> --}}
    </div>
    <div class="card">
        <div class="card-header h3 text-center">
            Localizações Cadastradas
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped text-center">
                    <thead>
                        <th>
                            Local
                        </th>
                        <th>
                            Opções
                        </th>
                    </thead>

                    <tbody>
                        @forelse ($locations as $local)
                            <tr>
                                <td>
                                    {{ $local->description ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('location.edit', ['id' => $local->id]) }}" class="btn btn-primary">Editar</a>
                                    <form class="d-inline" action="{{route('location.destroy', ['id' => $local->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Excluir" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        {{ $locations->links() }}
    </div>
@endsection
