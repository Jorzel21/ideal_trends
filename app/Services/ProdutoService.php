<?php

namespace App\Services;

use App\Http\Validators\CRUDValidator;
use App\Repositories\PedidoRepository;
use App\Repositories\ProdutoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProdutoService
{
    protected $produtoRepository;
    protected $pedidoRepository;

    public function __construct(
        ProdutoRepository $produtoRepository,
        PedidoRepository $pedidoRepository
    ) {
        $this->produtoRepository           = $produtoRepository;
        $this->pedidoRepository            = $pedidoRepository;
    }

    public function index($request)
    {
        try {
            return $this->produtoRepository->index($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            return $this->produtoRepository->getAll();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get($id)
    {
        try {
            return $this->produtoRepository->get($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws InvalidPixKeyTypeException
     * @throws DuplicatedExternalReferenceException
     */
    public function store($request)
    {
        $validator = Validator::make($request->all(), CRUDValidator::PRODUTO_STORE);

        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()->getMessages()));
        }

        try {
            DB::beginTransaction();
            $pix = $this->produtoRepository->store($request);
            DB::commit();
            return $pix;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, $data)
    {
        try {
            return $this->produtoRepository->update($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->pedidoRepository->destroyInCascadeProduto($id);
            return $this->produtoRepository->destroy($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
