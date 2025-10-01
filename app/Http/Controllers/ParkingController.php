<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{

    public function index()
    {
        $dados = Parking::all();
        return view('parking.list', ['dados' => $dados]);
    }

    public function create()
    {
        return view('parking.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo' => 'required',
            'motorista' => 'required',
            'hora_entrada' => 'required',
            'hora_saida' => 'required',
        ], [
            'modelo.required' => 'O modelo do veículo é obrigatório.',
            'motorista.required' => 'O nome do motorista é obrigatório.',
            'hora_entrada.required' => 'A hora de entrada é obrigatória.',
            'hora_saida.required' => 'A hora de saida é obrigatória.',
        ]);

        Parking::create($request->all());

        return redirect('parking');
    }

    public function edit(string $id)
    {
        $dado = Parking::findOrFail($id);
        return view('parking.form', ['dado' => $dado]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'modelo' => 'required',
            'motorista' => 'required',
            'hora_entrada' => 'required',
            'hora_saida' => 'required',
        ], [
            'modelo.required' => 'O modelo do veículo é obrigatório.',
            'motorista.required' => 'O nome do motorista é obrigatório.',
            'hora_entrada.required' => 'A hora de entrada é obrigatória.',
        ]);

        Parking::updateOrCreate(['id' => $id], $request->all());

        return redirect('parking');
    }

    public function destroy(string $id)
    {
        $dado = Parking::findOrFail($id);
        $dado->delete();

        return redirect('parking');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Parking::where(
                $request->tipo,
                'like',
                "%{$request->valor}%"
            )->get();
        } else {
            $dados = Parking::all();
        }

        return view('parking.list', ["dados" => $dados]);
    }
}
