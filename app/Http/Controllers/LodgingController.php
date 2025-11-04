<?php

namespace App\Http\Controllers;

use App\Models\Lodging;
use Illuminate\Http\Request;

class LodgingController extends Controller
{
    public function index()
    {
        $dados = Lodging::all();
        return view('lodging.list', compact('dados'));
    }

    public function create()
    {
        return view('lodging.form');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'nome_animal' => 'required',
            'dia_entrada' => 'required',
        ], [
            'nome.required' => 'O nome do tutor é obrigatório',
            'nome_animal.required' => 'O nome do animal é obrigatório',
            'dia_entrada.required' => 'A data de entrada é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Lodging::create($data);
        return redirect('lodging');
    }

    public function edit(string $id)
    {
        $dado = Lodging::findOrFail($id);
        return view('lodging.form', ['dado' => $dado]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Lodging::updateOrCreate(['id' => $id], $data);
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

    // retorna só o HTML do <tbody>
    return view('partials.lodging_table', compact('dados'))->render();
}

}