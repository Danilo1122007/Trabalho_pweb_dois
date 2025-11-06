<?php

namespace App\Http\Controllers;

use App\Models\Animals;
use Illuminate\Http\Request;

class AnimalsController extends Controller
{
    public function index()
    {
        $dados = Animals::all();
        return view('animals.list', ['dados' => $dados]);
    }

    public function create()
    {
        return view('animals.form');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome_animal' => 'required',
            'nome_tutor' => 'required',
            'raca' => 'required',
            'peso' => 'required|numeric',
            'telefone_tutor' => 'required',
        ], [
            'nome_animal.required' => 'O nome do animal é obrigatório',
            'nome_tutor.required' => 'O nome do tutor é obrigatório',
            'raca.required' => 'A raça é obrigatória',
            'peso.required' => 'O peso é obrigatório',
            'peso.numeric' => 'O peso deve ser um número',
            'peso.min' => 'O peso deve ser maior que zero',
            'telefone_tutor.required' => 'O telefone do tutor é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Animals::create($data);
        return redirect('animals');
    }

    public function edit(string $id)
    {
        $dado = Animals::findOrFail($id);
        return view('animals.form', ['dado' => $dado]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Animals::updateOrCreate(['id' => $id], $data);
        return redirect('animals');
    }

    public function destroy(string $id)
    {
        $dado = Animals::findOrFail($id);
        $dado->delete();
        return redirect('animals');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Animals::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Animals::all();
        }
        return view('animals.list', ["dados" => $dados]);
    }
}