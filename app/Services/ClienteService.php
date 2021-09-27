<?php

namespace App\Services;

use App\Http\Validators\CRUDValidator;
use App\Repositories\ClienteRepository;
use App\Repositories\PedidoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ClienteService
{
    protected $clienteRepository;
    protected $pedidoRepository;

    public function __construct(
        ClienteRepository $clienteRepository,
        PedidoRepository $pedidoRepository
    ) {
        $this->clienteRepository  = $clienteRepository;
        $this->pedidoRepository   = $pedidoRepository;
    }

    public function index($request)
    {
        try {
            return $this->clienteRepository->index($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            return $this->clienteRepository->getAll();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get($id)
    {
        try {
            return $this->clienteRepository->get($id);
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
        $validator = Validator::make($request->all(), CRUDValidator::CLIENTE_STORE);

        if ($validator->fails()) {
            throw new \Exception(json_encode($validator->errors()->getMessages()));
        }

        try {
            DB::beginTransaction();
            $pix = $this->clienteRepository->store($request);
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
            return $this->clienteRepository->update($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {
            $this->pedidoRepository->destroyInCascadeCliente($id);
            return $this->clienteRepository->destroy($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
