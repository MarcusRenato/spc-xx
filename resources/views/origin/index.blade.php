@extends('layouts.template')

@section('content')
    <div class="row justify-content-end my-4">
        <a href="{{ route('origem.create') }}" class="btn btn-success">
            Cadastrar Novo
        </a>
    </div>
    <div class="card">
        <div class="card-header h3 text-center">
            Origem dos Bens
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped text-center">
                    <thead>
                        <th>
                            Origem
                        </th>
                        <th>
                            Opções
                        </th>
                    </thead>

                    <tbody>
                        @forelse ($origins as $origin)
                            <tr>
                                <td>
                                    {{ $origin->description ?? '' }}
                                </td>
                                <td>
                                    <a href="{{ route('origem.edit', ['origem' => $origin->id]) }}" class="btn btn-primary">Editar</a>
                                    <form class="d-inline" action="{{route('origem.destroy', ['origem' => $origin->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
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
        {{ $origins->links() }}
    </div>
@endsection
