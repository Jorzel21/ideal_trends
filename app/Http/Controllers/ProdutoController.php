<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    protected $produtoService;

    /**
     * Create a new controller instance.
     *
     * @param ProdutoService $produtoService
     */
    public function __construct(
        ProdutoService $produtoService
    ) {
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
            $produtos = $this->produtoService->index($request);
            return view('produto.index', compact('produtos'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Produto não existe')->error();
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
        //
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
            $this->produtoService->store($request);
            flash('Produto adicionado com sucesso!')->success();
            return redirect()->route('produto.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Falha ao salvar produto! ', $e->getMessage())->error();
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
            $produto = $this->produtoService->get($id);
            return view('produto.edit', compact('produto'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Produto não encontrado!')->error();
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
            $this->produtoService->update($id, $request);
            flash('Produto atualizado com sucesso!')->success();
            return redirect()->route('produto.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Falha ao atualizar produto! ', $e->getMessage())->error();
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

    public function get($id)
    {
        try {
            $produto = $this->produtoService->get($id);
            return $produto;
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Produto não encontrado!')->error();
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        try {
            $this->produtoService->destroy($request->id);
            flash('Produto excluído com sucesso!')->success();
            return redirect()->route('produto.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Produto não existe')->error();
            return redirect()->back();
        }
    }
}
