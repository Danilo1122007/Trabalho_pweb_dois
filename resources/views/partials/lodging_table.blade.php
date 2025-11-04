<tbody>
    @forelse($dados as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nome }}</td>
            <td>{{ $item->nome_animal }}</td>
            <td>{{ $item->dia_entrada }}</td>
            <td>{{ $item->dia_saida }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">Nenhum registro encontrado</td>
        </tr>
    @endforelse
</tbody>
