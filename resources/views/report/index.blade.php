<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPC - XX</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            margin-top: 10px;
        }
        .header {
            width: 100%;
            text-align: center;
        }
        table {
            width: 95%;
            text-align: center;
            margin: auto;
            margin-top: 10px;
            border-collapse: collapse;
        }
        td, th {
            padding: 12px
        }
        th {
            background-color: #CCC;
            font-size: 18px;
        }
        table, th, td {
            border: 1px solid black;
        }

    </style>
</head>

<body>

    <div class="header">
        <h1>Universidade do Estado do Pará</h1>

        <h2>Campus XX - Castanhal</h2>
    </div>

    <main>
        <table>
            <thead>
                <tr>
                    <th>
                        RP
                    </th>
                    <th>
                        Descrição
                    </th>
                    <th>
                        Estado
                    </th>
                    <th>
                        Localização
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($patrimonies as $item)

                        <tr>
                            <td>
                                {{ $item->rp ?? ''}}
                            </td>
                            <td>
                                {{ $item->descricao ?? ''}}
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
                        </tr>

                @endforeach
            </tbody>
        </table>

    </main>
</body>

</html>
