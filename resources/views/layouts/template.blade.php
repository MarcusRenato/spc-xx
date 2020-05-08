<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPC - XX</title>
    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/material-icons-min.css') }}" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark text-white" style="background-color: #001c7d;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"><strong>SPC - XX</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto font-weight-bold text-white">
                    @auth
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-2" href="{{route('patrimony.index')}}">
                                Patrimônio
                            </a>
                        </li>

                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-2" href="{{route('patrimony.form.relatorio')}}">
                                Relatório
                            </a>
                        </li>

                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-2" href="{{route('location.index')}}">
                                Localização
                            </a>
                        </li>

                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-2" href="{{route('origem.index')}}">
                                Origem
                            </a>
                        </li>
                        @can('super')
                            <li class="nav-item mx-0 mx-lg-1">
                                <a class="nav-link py-3 px-0 px-lg-2" href="{{route('adminindex')}}">
                                    Usuários
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-2" href="{{ route('logout') }}" onclick="return confirm('Tem certeza que deseja sair?')">
                                Sair
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4 text-center">
        <h1>Universidade do Estado do Pará</h1>

        <h2>Campus XX - Castanhal</h2>
        <h2>Controle de Patrimônio</h2>
    </div>

    <main class="bg-light" style="height: 100%">

        <div class="container mb-4">
            @include('sweetalert::alert')

            @yield('content')
        </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#flash-overlay-modal').modal();
        // $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
</body>

</html>
