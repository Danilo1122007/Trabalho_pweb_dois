<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->paginate(10);
        return view('products.list', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:produto,servico',
            'quantity' => 'nullable|integer|min:0',
            'service_date' => 'nullable|date',
            'service_time' => 'nullable',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 🔸 imagem opcional
        ]);
    }

public function store(Request $request)
{
    $data = $this->validateRequest($request);

    if ($data['type'] === 'servico') {
        $data['quantity'] = 0;
    }

    if (
        $data['type'] === 'servico' &&
        !empty($data['service_date']) &&
        !empty($data['service_time'])
    ) {
        $count = Product::where('type', 'servico')
            ->where('service_date', $data['service_date'])
            ->where('service_time', $data['service_time'])
            ->count();

        if ($count >= 3) {
            return back()->withErrors('Limite máximo de 3 serviços nesse horário e data.');
        }
    }

    if ($request->hasFile('imagem')) {
        $folder = $data['type'] === 'servico' ? 'imagens/servicos' : 'imagens/produtos';
        $data['imagem'] = $request->file('imagem')->store($folder, 'public');
    }

    $data['launch_date'] = now();
    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
}

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $data = $this->validateRequest($request);

    if ($data['type'] === 'servico') {
        $data['quantity'] = 0;
    }

    if ($request->hasFile('imagem')) {
        $folder = $data['type'] === 'servico' ? 'imagens/servicos' : 'imagens/produtos';

        if ($product->imagem && Storage::disk('public')->exists($product->imagem)) {
            Storage::disk('public')->delete($product->imagem);
        }

        $data['imagem'] = $request->file('imagem')->store($folder, 'public');
    }

    $data['update_date'] = now();
    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Atualizado com sucesso!');
}

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->imagem && Storage::disk('public')->exists($product->imagem)) {
            Storage::disk('public')->delete($product->imagem);
        }

        $product->delete();
        return back()->with('success', 'Removido com sucesso!');
    }


public function search(Request $request)
{
    $query = Product::query();

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->orderBy('name')->paginate(10)->appends($request->query());

    return view('products.list', compact('products'));
}



public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);

    if ($product->type === 'servico') {
        $quantity = 1;
    } else {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        $quantity = $validated['quantity'];

        if ($product->quantity < $quantity) {
            return back()->withErrors('Quantidade solicitada maior que o estoque disponível.');
        }
    }

    $userId = Auth::id();
    $sessionId = session()->getId();

    $where = $userId
        ? ['product_id' => $id, 'user_id' => $userId]
        : ['product_id' => $id, 'session_id' => $sessionId];

    $cart = Cart::where($where)->first();

    if ($cart) {
        $cart->increment('quantity', $quantity);
    } else {
        Cart::create(array_merge($where, ['quantity' => $quantity]));
    }

    return back()->with('success', $product->type === 'servico'
        ? 'Serviço agendado com sucesso!'
        : 'Adicionado ao carrinho!');
}
}
