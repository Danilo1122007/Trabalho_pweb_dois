<?php

namespace App\Http\Controllers;

use App\Models\Animals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'nullable|image|mimes:png,jpg,jpeg'
        ], [
            'nome_animal.required' => 'O nome do animal é obrigatório',
            'nome_tutor.required' => 'O nome do tutor é obrigatório',
            'raca.required' => 'A raça é obrigatória',
            'peso.required' => 'O peso é obrigatório',
            'peso.numeric' => 'O peso deve ser um número',
            'telefone_tutor.required' => 'O telefone do tutor é obrigatório',
            'foto.image' => 'A foto deve ser uma imagem',
            'foto.mimes' => 'A foto deve ser das extensões: PNG, JPEG, JPG',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();
        $foto = $request->file('foto');

        if ($foto) {
            $nome_foto = date('YmdiHs') . "." . $foto->getClientOriginalExtension();
            $diretorio = "imagem/animal/";

            $foto->storeAs(
                $diretorio,
                $nome_foto,
                'public'
            );
            $data['foto'] = $diretorio . $nome_foto;
        }

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
        $foto = $request->file('foto');

        if ($foto) {
            $nome_foto = date('YmdiHs') . "." . $foto->getClientOriginalExtension();
            $diretorio = "imagem/animal/";

            $foto->storeAs(
                $diretorio,
                $nome_foto,
                'public'
            );
            $data['foto'] = $diretorio . $nome_foto;
        }

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

    public function searchAjax(Request $request)
    {
        $tipo = $request->tipo ?? 'nome_animal';
        $valor = $request->valor ?? '';

        $dados = Animals::when($valor, function ($query) use ($tipo, $valor) {
            $query->where($tipo, 'like', "%{$valor}%");
        })->get();

        return view('partials.animals_table', compact('dados'))->render();
    }
}