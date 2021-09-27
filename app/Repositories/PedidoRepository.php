<?php

namespace App\Repositories;

use App\Models\Pedido;
use App\Models\PedidoProduto;

class PedidoRepository 
{

    protected $pedido;
    protected $pedidoProduto;

    public function __construct(Pedido $pedido, PedidoProduto $pedidoProduto)
    {
        $this->pedido = $pedido;
        $this->pedidoProduto = $pedidoProduto;
    }

    public function index($request)
    {
        return $this->pedido
        ->when($request->get('id'), function ($query) use ($request) {
            return $query->where('id', $request['id']);
        })
        ->when($request->get('cliente_id'), function ($query) use ($request) {
            return $query->where('cliente_id', $request['cliente_id']);
        })
        ->when($request->get('status'), function ($query) use ($request) {
            return $query->where('status', $request['status']);
        })       
        ->when($request->get('toDate'), function ($query) use ($request) {
            return $query->where('created_at', '>=', $request['toDate']);
        })
        ->when($request->get('fromDate'), function ($query) use ($request) {
            return $query->where('created_at', '<=', $request['fromDate']);
        })
        ->sortable(['id' => 'desc'])->paginate(20);
    }

    public function get($id)
    {
        return $this->pedido->findOrFail($id);
    }

    public function getProdutos($id)
    {
        try{
            return $this->pedidoProduto->where('pedido_id',$id)->get();
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function store($request)
    {
        try{
            $this->pedido->cliente_id      = $request->cliente;
            $this->pedido->save();
   
            return $this->pedido;
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
            $this->pedido                = $this->get($id);
            $this->pedido->status        = $request->status;
            $this->pedido->save();        
            return $this->pedido;
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    public function destroy($id)
    {   
        $this->pedidoProduto->where('pedido_id',$id)->delete();
        return $this->pedido->find($id)->delete();
    }

    public function destroyInCascadeCliente($id)
    {
        $idsPedidos = $this->pedido->where('cliente_id',$id)->groupBy('id')->pluck('id','id');
        $this->pedidoProduto->whereIn('pedido_id',$idsPedidos)->delete();
        return $this->pedido->whereIn('id',$idsPedidos)->delete();
    }

    public function destroyInCascadeProduto($id)
    {
        $idsPedidos = $this->pedidoProduto->where('produto_id',$id)->groupBy('pedido_id')->pluck('pedido_id','pedido_id');
        $this->pedidoProduto->where('produto_id',$id)->delete();
        return $this->pedido->whereIn('id',$idsPedidos)->delete();
    }
    public function storeProdutos($pedidoId, $request)
    {
        try{
            $this->pedidoProduto                = new PedidoProduto();
            $this->pedidoProduto->pedido_id     = $pedidoId;
            $this->pedidoProduto->produto_id    = $request->produto->id;
            $this->pedidoProduto->quantidade    = $request->quantidade;
            $this->pedidoProduto->obs           = $request->obs;
            $this->pedidoProduto->save();
   
            return $this->pedidoProduto;
        }
        catch (\Exception $e){
            throw $e;
        }
    }
    

}
