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

    /**
     * 🔹 Validação dos campos
     */
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

    /**
     * 🔹 Salva um novo produto ou serviço
     */
public function store(Request $request)
{
    $data = $this->validateRequest($request);

    // 🔹 Se for serviço, define quantidade = 0
    if ($data['type'] === 'servico') {
        $data['quantity'] = 0;
    }

    // 🔸 Verifica limite de serviços no mesmo horário/data
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

    // 🔸 Upload de imagem
    if ($request->hasFile('imagem')) {
        $folder = $data['type'] === 'servico' ? 'imagens/servicos' : 'imagens/produtos';
        $data['imagem'] = $request->file('imagem')->store($folder, 'public');
    }

    $data['launch_date'] = now();
    Product::create($data);

    return redirect()->route('products.index')->with('success', 'Cadastrado com sucesso!');
}
    /**
     * 🔹 Exibe formulário de edição
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * 🔹 Atualiza produto ou serviço existente
     */
public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);
    $data = $this->validateRequest($request);

    // 🔹 Se for serviço, define quantidade = 0
    if ($data['type'] === 'servico') {
        $data['quantity'] = 0;
    }

    // 🔸 Substituição da imagem
    if ($request->hasFile('imagem')) {
        $folder = $data['type'] === 'servico' ? 'imagens/servicos' : 'imagens/produtos';

        // Apaga imagem antiga
        if ($product->imagem && Storage::disk('public')->exists($product->imagem)) {
            Storage::disk('public')->delete($product->imagem);
        }

        // Salva nova imagem
        $data['imagem'] = $request->file('imagem')->store($folder, 'public');
    }

    $data['update_date'] = now();
    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Atualizado com sucesso!');
}

    /**
     * 🔹 Exclui produto e remove imagem associada
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->imagem && Storage::disk('public')->exists($product->imagem)) {
            Storage::disk('public')->delete($product->imagem);
        }

        $product->delete();
        return back()->with('success', 'Removido com sucesso!');
    }

    /**
     * 🔹 Pesquisa de produtos e serviços
     */
public function search(Request $request)
{
    $query = Product::query();

    // 🔹 Filtro por tipo (produto ou serviço)
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // 🔹 Filtro por nome (busca parcial)
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // 🔹 Paginação com filtros preservados
    $products = $query->orderBy('name')->paginate(10)->appends($request->query());

    return view('products.list', compact('products'));
}


    /**
     * 🔹 Adiciona produto ao carrinho
     */
public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);

    if ($product->type === 'servico') {
        // 🔹 Serviços não precisam de quantidade
        $quantity = 1;
    } else {
        // 🔹 Produtos precisam validar quantidade
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
