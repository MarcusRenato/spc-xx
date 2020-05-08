@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header h3 text-center">
            Cadastro de Localização
        </div>

        <div class="card-body">
            <form action="{{ route('location.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="description">
                        Local
                    </label>
                    <input type="text" name="description" id="description" class="form-control @error('description') is-invalid  @enderror" value="{{ old('description') }}">

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <input type="submit" value="Cadastrar" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
