@forelse ($dados as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->modelo }}</td>
        <td>{{ $item->motorista }}</td>
        <td>{{ $item->vehicleType->nome ?? 'N/A' }}</td>
        <td>{{ $item->hora_entrada }}</td>
        <td>{{ $item->hora_saida ?? '-' }}</td>
        <td class="text-center">
            <a href="{{ route('parking.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        </td>
        <td class="text-center">
            <form action="{{ route('parking.destroy', $item->id) }}" method="POST"
                  onsubmit="return confirm('Deseja remover o registro?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center">Nenhum registro encontrado.</td>
    </tr>
@endforelse
