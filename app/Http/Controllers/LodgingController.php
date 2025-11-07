<?php

namespace App\Http\Controllers;

use App\Models\Lodging;
use App\Models\Animals;
use Illuminate\Http\Request;
use PDF;

class LodgingController extends Controller
{
    public function index()
    {
        $dados = Lodging::with('animal')->get();
        return view('lodging.list', compact('dados'));
    }

    public function create()
    {
        $animais = Animals::all();
        return view('lodging.form', compact('animais'));
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'dia_entrada' => 'required',
            'dia_saida' => 'required',

        ], [
            'animal_id.required' => 'O animal é obrigatório',
            'dia_entrada.required' => 'A data de entrada é obrigatória',
            'dia_saida.required' => 'A data de entrada é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        Lodging::create($request->all());
        return redirect('lodging');
    }

    public function edit(string $id)
    {
        $dado = Lodging::findOrFail($id);
        $animais = Animals::all();
        return view('lodging.form', ['dado' => $dado, 'animais' => $animais]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        Lodging::updateOrCreate(['id' => $id], $request->all());
        return redirect('lodging');
    }

    public function destroy(string $id)
    {
        $dado = Lodging::findOrFail($id);
        $dado->delete();
        return redirect('lodging');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Lodging::where($request->tipo, 'like', "%$request->valor%")->get();
        } else {
            $dados = Lodging::all();
        }
        return view('lodging_table', ["dados" => $dados]);
    }

    public function searchAjax(Request $request)
    {
        $tipo = $request->tipo ?? 'nome';
        $valor = $request->valor ?? '';

        $dados = Lodging::when($valor, function ($query) use ($tipo, $valor) {
            $query->where($tipo, 'like', "%{$valor}%");
        })->get();

        return view('partials.lodging_table', compact('dados'))->render();
    }

    public function report()
    {
        $dados = Lodging::with('animal')->orderBy('dia_entrada')->get();

        $data = [
            'titulo' => 'Relatório de Reservas de Estadia',
            'dados' => $dados,
        ];

        $pdf = PDF::loadView('lodging.report', $data);
        return $pdf->download('relatorio_reservas_estadia.pdf');
    }
}
