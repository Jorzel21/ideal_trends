<?php

namespace App\Services;

use App\Http\Validators\CRUDValidator;
use App\Repositories\PedidoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class PedidoService
{
    protected $pedidoRepository;

    public function __construct(
        PedidoRepository $pedidoRepository    )
    {
        $this->pedidoRepository            = $pedidoRepository;
    }

    public function index($request)
    {
        try{
            return $this->pedidoRepository->index($request);
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    public function get($id)
    {
        try{
            return $this->pedidoRepository->get($id);
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    public function getProdutos($id)
    {
        try{
            return $this->pedidoRepository->getProdutos($id);
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * @throws InvalidPixKeyTypeException
     * @throws DuplicatedExternalReferenceException
     */
    public function store($request)
    {
        // $validator = Validator::make($request->all(), CRUDValidator::PRODUTO_STORE);

        // if ($validator->fails()) {
        //     throw new \Exception(json_encode($validator->errors()->getMessages()));
        // }

        try{
            DB::beginTransaction();
            $pedido = $this->pedidoRepository->store($request);
            $produtosAdd = json_decode($request->produtosAdd);
            foreach($produtosAdd  as $produto){
                $this->pedidoRepository->storeProdutos($pedido->id, $produto);
            }
            DB::commit();
            return $pedido;
        }
        catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
 
    public function update($id, $data)
    {
        try{
            return $this->pedidoRepository->update($id, $data);
        }
        catch (\Exception $e){
            throw $e;
        }
    }

    public function destroy($id)
    {
        try{
            return $this->pedidoRepository->destroy($id);
        }
        catch (\Exception $e){
            throw $e;
        }
    }
}
