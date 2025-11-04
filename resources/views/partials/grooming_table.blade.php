<tbody>
    @forelse ($dados as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->nome_animal }}</td>
            <td>{{ $item->raca }}</td>
            <td>{{ $item->horario_atendimento }}</td>
            <td>{{ $item->telefone_tutor ?? '-' }}</td>
            <td>
                <button class="btn btn-outline-warning btn-sm edit-btn" data-id="{{ $item->id }}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $item->id }}">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Nenhum registro encontrado</td>
        </tr>
    @endforelse
</tbody>
