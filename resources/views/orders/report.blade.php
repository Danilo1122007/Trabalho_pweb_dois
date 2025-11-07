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
        .order-header {
            margin-top: 25px;
            font-size: 14px;
            font-weight: bold;
        }
        hr {
            margin: 10px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
        .descricao {
            text-align: left;
            background: #fafafa;
            font-style: italic;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <h2>{{ $titulo }}</h2>

    @forelse ($dados as $order)
        <div class="order-header">
            Pedido #{{ $order->id }} — {{ date('d/m/Y H:i', strtotime($order->order_date)) }}
            <br>
            Total: R$ {{ number_format($order->total_price, 2, ',', '.') }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Tipo</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    @php
                        $produto = $item->product;
                        $nome_imagem = $produto && !empty($produto->imagem) ? $produto->imagem : 'sem_imagem.png';
                        $imagemPath = public_path('storage/' . $nome_imagem);
                    @endphp
                    <tr>
                        <td rowspan="2">
                            @if(file_exists($imagemPath))
                                <img src="{{ $imagemPath }}" width="60" height="60">
                            @else
                                <span>Sem imagem</span>
                            @endif
                        </td>
                        <td>{{ $produto->name ?? 'Produto removido' }}</td>
                        <td>{{ $produto->type ?? '-' }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <td colspan="5" class="descricao">
                            <strong>Descrição:</strong>
                            {{ $produto->description ?? 'Sem descrição disponível.' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
    @empty
        <p style="text-align:center;">Nenhum pedido encontrado.</p>
    @endforelse
</body>
</html>
