<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository
{

    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index($request)
    {        
        return $this->cliente
        ->when($request->get('id'), function ($query) use ($request) {
            return $query->where('id', $request['id']);
        })
        ->when($request->get('nome'), function ($query) use ($request) {
            return $query->where('nome', 'like', '%' .  $request['nome'] . '%');
        })
        ->when($request->get('cpf'), function ($query) use ($request) {
            return $query->where('cpf', $request['cpf']);
        })
        ->sortable(['id' => 'desc'])->paginate(20);
    }

    public function getAll()
    {
        return $this->cliente->select('id','nome')->get()->pluck('nome', 'id');
    }

    public function get($id)
    {
        return $this->cliente->findOrFail($id);
    }

    /**
     * @throws \Exception
     */
    public function store($request)
    {
        try {
            $this->cliente->nome         = $request->nome;
            $this->cliente->cpf          = $request->cpf;
            $this->cliente->email        = $request->email;
            $this->cliente->nascimento   = $request->nascimento;
            $this->cliente->cep          = $request->cep;
            $this->cliente->rua          = $request->rua;
            $this->cliente->numero       = $request->numero;
            $this->cliente->bairro       = $request->bairro;
            $this->cliente->uf           = $request->uf;
            $this->cliente->cidade       = $request->cidade;
            $this->cliente->complemento  = $request->complemento;
            $this->cliente->telefone     = $request->telefone;


            $this->cliente->save();

            return $this->cliente;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function update($id, $request)
    {
        info($request);
        try {
            $this->cliente               = $this->get($id);
            $this->cliente->nome         = $request->nome;
            $this->cliente->email        = $request->email;
            $this->cliente->nascimento   = $request->nascimento;
            $this->cliente->cep          = $request->cep;
            $this->cliente->rua          = $request->rua;
            $this->cliente->numero       = $request->numero;
            $this->cliente->bairro       = $request->bairro;
            $this->cliente->uf           = $request->uf;
            $this->cliente->cidade       = $request->cidade;
            $this->cliente->complemento  = $request->complemento;
            $this->cliente->telefone     = $request->telefone;

            $this->cliente->save();
            return $this->cliente;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($id)
    {
        return $this->cliente->find($id)->delete();
    }
}
