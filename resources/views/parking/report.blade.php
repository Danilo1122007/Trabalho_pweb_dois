<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
        }
        th {
            background: #f2f2f2;
        }
        img {
            object-fit: cover;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>{{ $titulo }}</h2>

    <table>
        <thead>
            <tr>
                <th>Imagem</th>
                <th>#ID</th>
                <th>Modelo</th>
                <th>Motorista</th>
                <th>Tipo</th>
                <th>Peso</th>
                <th>Entrada</th>
                <th>Saída</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dados as $item)
                @php
                    $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.png';
                    $imagemPath = public_path('storage/' . $nome_imagem);
                @endphp
                <tr>
                    <td><img src="{{ $imagemPath }}" width="70" height="70"></td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->motorista }}</td>
                    <td>{{ $item->vehicleType->nome ?? '-' }}</td>
                    <td>{{ $item->weightClass->nome ?? '-' }}</td>
                    <td>{{ $item->hora_entrada ?? '-' }}</td>
                    <td>{{ $item->hora_saida ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">Nenhum registro encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
