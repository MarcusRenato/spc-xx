@extends('layouts.template')

@section('content')

    <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
            <div class="col-sm-8 mb-4">
                <div class="card">
                    <div class="card-header text-center h3">
                        Cadastrar novo usuário
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('name', 'Nome') !!}

                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('email', 'E-mail') !!}

                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('function', 'Cargo') !!}

                            <input type="text" name="function" id="function" class="form-control @error('function') is-invalid @enderror" value="{{ $user->function }}" required>
                            @error('function')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            {!! Form::label('password', 'Senha') !!}

                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            {!! Form::label('password', 'Confirme a Senha') !!}

                            <input type="password" name="password_confirmation" id="password" class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="submit" value="Atualizar" class="btn btn-primary form-control">
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
