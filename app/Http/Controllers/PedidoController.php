<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use App\Services\PedidoService;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    protected $pedidoService;
    protected $clienteService;
    protected $produtoService;

    /**
     * Create a new controller instance.
     *
     * @param PedidoService $pedidoService
     * @param ClienteService $clienteService
     * @param ProdutoService $produtoService
     */
    public function __construct(
        PedidoService $pedidoService, ClienteService $clienteService, ProdutoService $produtoService
    ) {
        $this->pedidoService    = $pedidoService;
        $this->clienteService   = $clienteService;
        $this->produtoService   = $produtoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        try {
            $pedidos = $this->pedidoService->index($request);
            $clientes = $this->clienteService->getAll();
            return view('pedido.index', compact('pedidos', 'clientes'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não existe')->error();
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $clientes = $this->clienteService->getAll();
            $produtos = $this->produtoService->getAll();
            return view('pedido.create', compact('clientes', 'produtos'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não existe')->error();
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->pedidoService->store($request);
            flash('Pedido adicionado com sucesso!')->success();
            return redirect()->route('pedido.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não existe')->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $pedido = $this->pedidoService->get($id);
            $produtos = $this->pedidoService->getProdutos($id);
            $clientes = $this->clienteService->getAll();
            return view('pedido.edit', compact('pedido', 'produtos', 'clientes'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não encontrado!')->error();
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->pedidoService->update($id, $request);
            flash('Pedido atualizado com sucesso!')->success();
            return redirect()->route('pedido.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não existe')->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        try {
            $this->pedidoService->destroy($request->id);
            flash('Pedido excluído com sucesso!')->success();
            return redirect()->route('pedido.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Pedido não existe')->error();
            return redirect()->back();
        }
    }
}
