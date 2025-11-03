<?php

namespace App\Http\Controllers;

use App\Models\Lodging;
use App\Models\Animals;
use Illuminate\Http\Request;

class LodgingController extends Controller
{
    public function index()
    {
        $dados = Lodging::with('animal')->get();
        return view('lodging.list', ['dados' => $dados]);
    }

    public function create()
    {
        $animais = Animals::all();
        return view('lodging.form', ['animais' => $animais]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'animal_id' => 'required|exists:animals,id',
            'dia_entrada' => 'required',
            'dia_saida' => 'required',
        ], [
            'nome.required' => 'O nome do tutor é obrigatório',
            'animal_id.required' => 'O animal é obrigatório',
            'dia_entrada.required' => 'A data de entrada é obrigatória',
            'dia_saida.required' => 'A data de saida é obrigatória',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $animal = Animals::find($data['animal_id']);
        $data['nome_animal'] = $animal->nome_animal;

        Lodging::create($data);
        return redirect('lodging');
    }

    public function edit(string $id)
    {
        $dado = Lodging::findOrFail($id);
        $animais = Animals::all();
        return view('lodging.form', [
            'dado' => $dado,
            'animais' => $animais
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $animal = Animals::find($data['animal_id']);
        $data['nome_animal'] = $animal->nome_animal;

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
            $dados = Lodging::with('animal')
                ->where($request->tipo, 'like', "%$request->valor%")
                ->get();
        } else {
            $dados = Lodging::with('animal')->get();
        }
        return view('lodging.list', ["dados" => $dados]);
    }
}