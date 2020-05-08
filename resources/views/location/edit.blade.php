@extends('layouts.template')


@section('content')
<div class="card">
    <div class="card-header h3 text-center">
        Editar informaçõoes de Localização
    </div>

    <div class="card-body">
        <form action="{{ route('location.update', ['id' => $location->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="description">
                    Local
                </label>
                <input type="text" name="description" id="description" class="form-control @error('description') is-invalid  @enderror" value="{{ $location->description }}">

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
