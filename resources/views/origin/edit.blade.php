@extends('layouts.template')


@section('content')
<div class="card">
    <div class="card-header h3 text-center">
        Editar informaçõoes de Origem dos Bens
    </div>

    <div class="card-body">
        <form action="{{ route('origem.update', ['origem' => $origin->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description">
                    Local
                </label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid  @enderror" value="{{ $origin->description }}">

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <input type="submit" value="Atualizar" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
