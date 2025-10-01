<?php

namespace App\Http\Controllers;

use App\Models\Grooming;
use Illuminate\Http\Request;

class GroomingController extends Controller
{
    public function index()
    {
        $dados = Grooming::all();
        return view('grooming.list', ['dados' => $dados]);
    }

    public function create()
    {
        return view('grooming.form');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome_animal' => 'required',
            'raca' => 'required',
            'horario_atendimento' => 'required',
            'telefone_tutor' => 'required',
        ], [
            'nome_animal.required' => 'O nome do animal é obrigatório',
            'raca.required' => 'A raça é obrigatória',
            'horario_atendimento.required' => 'O horário de atendimento é obrigatório',
            'htelefone_tutor.required' => 'O telefone do tutor é obrigatório',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Grooming::create($data);
        return redirect('grooming');
    }

    public function edit(string $id)
    {
        $dado = Grooming::findOrFail($id);
        return view('grooming.form', ['dado' => $dado]);
    }

    public function update(Request $request, string $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Grooming::updateOrCreate(['id' => $id], $data);
        return redirect('grooming');
    }

    public function destroy(string $id)
    {
        $dado = Grooming::findOrFail($id);
        $dado->delete();
        return redirect('grooming');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Grooming::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Grooming::all();
        }
        return view('grooming.list', ["dados" => $dados]);
    }
}
