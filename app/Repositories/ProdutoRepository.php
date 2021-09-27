<?php

namespace App\Repositories;

use App\Models\Produto;

class ProdutoRepository 
{

    protected $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index($request)
    {
        return $this->produto
        ->when($request->get('id'), function ($query) use ($request) {
            return $query->where('id', $request['id']);
        })
        ->when($request->get('nome'), function ($query) use ($request) {
            return $query->where('nome', 'like', '%' .  $request['nome'] . '%');
        })
        ->when($request->get('valor'), function ($query) use ($request) {
            return $query->where('valor', (float) $request['valor']);
        })
        ->when($request->get('codBarras'), function ($query) use ($request) {
            return $query->where('codBarras', $request['codBarras']);
        })
        ->sortable(['id' => 'desc'])->paginate(20);
    }

    public function getAll()
    {
        return $this->produto->get()->pluck('nome', 'id');
    }

    public function get($id)
    {
        return $this->produto->findOrFail($id);
    }

    /**
     * @throws \Exception
     */
    public function store($request)
    {
        try{
            $this->produto->nome              = $request->nome;
            $this->produto->descricao         = $request->descricao;
            $this->produto->codBarras          = $request->codBarras;
            $this->produto->valor             = (float) $request->valor;
            $this->produto->save();
   
            return $this->produto;
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function update($id, $request)
    {
        try{
            $this->produto                    = $this->get($id);
            $this->produto->nome              = $request->nome;
            $this->produto->descricao         = $request->descricao;
            $this->produto->codBarras         = $request->codBarras;
            $this->produto->valor             = (float)$request->valor;
            $this->produto->save();        
            return $this->produto;
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    public function destroy($id)
    {
        return $this->produto->find($id)->delete();
    }

}
