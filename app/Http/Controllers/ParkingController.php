<?php

namespace App\Http\Controllers;

use App\Charts\ParkingQtdChart;
use App\Models\Parking;
use App\Models\VehicleType;
use App\Models\WeightClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class ParkingController extends Controller
{
    /** Número máximo de vagas no estacionamento */
    private const LIMITE_VAGAS = 50;

    public function index()
    {
        // Eager loading (carrega também o tipo de veículo)
        $dados = Parking::with('vehicleType')->get();

        // Conta apenas os veículos ainda estacionados
        $ocupadas = Parking::whereNull('hora_saida')->count();
        $totalVagas = self::LIMITE_VAGAS;
        $livres = $totalVagas - $ocupadas;

        return view('parking.list', [
            'dados' => $dados,
            'ocupadas' => $ocupadas,
            'livres' => $livres,
            'total' => $totalVagas
        ]);
    }

    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $weightClasses = WeightClass::all();

        return view('parking.form', compact('vehicleTypes', 'weightClasses'));
    }

    /** Validação reutilizável */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'modelo' => 'required',
            'motorista' => 'required',
            'hora_entrada' => 'required',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'weight_class_id' => 'required|exists:weight_classes,id',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg'
        ], [
            'modelo.required' => 'O modelo é obrigatório',
            'motorista.required' => 'O motorista é obrigatório',
            'hora_entrada.required' => 'A hora de entrada é obrigatória',
            'vehicle_type_id.required' => 'O tipo de veículo é obrigatório',
            'vehicle_type_id.exists' => 'Tipo de veículo inválido',
            'weight_class_id.required' => 'A classe de peso é obrigatória',
            'weight_class_id.exists' => 'Classe de peso inválida',
            'imagem.image' => 'A imagem deve ser válida',
            'imagem.mimes' => 'A imagem deve ser PNG, JPEG ou JPG',
        ]);
    }

    public function store(Request $request)
    {
        // Limite de vagas
        if (Parking::whereNull('hora_saida')->count() >= self::LIMITE_VAGAS) {
            return redirect('parking')->with('error', 'Estacionamento lotado! Limite de 50 vagas atingido.');
        }

        $this->validateRequest($request);

        $data = $request->only([
            'modelo',
            'motorista',
            'hora_entrada',
            'hora_saida',
            'vehicle_type_id',
            'weight_class_id'
        ]);

        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/parking/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Parking::create($data);

        return redirect('parking')->with('success', 'Veículo registrado com sucesso!');
    }

    public function edit(string $id)
    {
        $dado = Parking::findOrFail($id);
        $vehicleTypes = VehicleType::all();
        $weightClasses = WeightClass::all();

        return view('parking.form', compact('vehicleTypes', 'weightClasses', 'dado'));
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);

        $data = $request->only([
            'modelo',
            'motorista',
            'hora_entrada',
            'hora_saida',
            'vehicle_type_id',
            'weight_class_id'
        ]);

        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/parking/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Parking::where('id', $id)->update($data);

        return redirect('parking')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $dado = Parking::findOrFail($id);

        if ($dado->imagem && Storage::disk('public')->exists($dado->imagem)) {
            Storage::disk('public')->delete($dado->imagem);
        }

        $dado->delete();

        return redirect('parking')->with('success', 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $query = Parking::with('vehicleType');

        if (!empty($request->valor)) {
            if ($request->tipo === 'vehicle_type_id') {
                // Busca pelo nome do tipo de veículo
                $query->whereHas('vehicleType', function ($q) use ($request) {
                    $q->where('nome', 'like', "%{$request->valor}%");
                });
            } else {
                $query->where($request->tipo, 'like', "%{$request->valor}%");
            }
        }

        $dados = $query->get();

        $totalVagas = self::LIMITE_VAGAS;
        $ocupadas = Parking::whereNull('hora_saida')->count();
        $livres = $totalVagas - $ocupadas;

        return view('parking.list', [
            'dados' => $dados,
            'total' => $totalVagas,
            'ocupadas' => $ocupadas,
            'livres' => $livres
        ]);
    }

public function report()
{
    $orders = Order::with('items.product')
        ->where('user_id', Auth::id())
        ->orderBy('id')
        ->get();

    $data = [
        'titulo' => 'Relatório de Pedidos',
        'dados'  => $orders,
    ];

    $pdf = \PDF::loadView('orders.report', $data);

    return $pdf->download('relatorio_pedidos.pdf');
}

}
