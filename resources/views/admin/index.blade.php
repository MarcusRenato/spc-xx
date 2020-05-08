@extends('layouts.template')

@section('content')

    <div class="row justify-content-end my-4">
        <a class="btn btn-success" href="{{ route('user.create') }}">Cadastrar Novo</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover text-center">
            <thead>
                <th>
                    Nome
                </th>
                <th>
                    Email
                </th>
                <th>
                    Cargo
                </th>
                <th>
                    Opções
                </th>
            </thead>

            @forelse ($users as $user)
                <tbody>
                    <td>
                        {{ $user->name ?? '' }}
                    </td>
                    <td>
                        {{ $user->email ?? '' }}
                    </td>
                    <td>
                        {{ $user->function ?? '' }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('user.edit', ['id' => $user->id]) }}">Editar</a>

                        @if ($loggedId != $user->id)
                            <form class="d-inline" action="{{route('user.delete', ['id' => $user->id])}}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Excluir" class="btn btn-danger">
                            </form>
                        @endif
                    </td>
                </tbody>
            @empty

        @endforelse

        </table>
    </div>

@endsection
