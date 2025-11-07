<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Reservas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .date {
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $titulo }}</h1>
        <div class="date">Gerado em: {{ date('d/m/Y H:i:s') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#ID</th>
                <th>Animal</th>
                <th>Tutor</th>
                <th>Dia Entrada</th>
                <th>Dia Saída</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->animal->nome_animal }}</td>
                    <td>{{ $item->animal->nome_tutor }}</td>
                    <td>{{ $item->dia_entrada ? \Carbon\Carbon::parse($item->dia_entrada)->format('d/m/Y') : '-' }}</td>
                    <td>{{ $item->dia_saida ? \Carbon\Carbon::parse($item->dia_saida)->format('d/m/Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px; text-align: center; font-size: 10px; color: #666;">
        Total de reservas: {{ $dados->count() }}
    </div>
</body>
</html>