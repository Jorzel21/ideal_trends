<?php


namespace App\Http\Validators;


class CRUDValidator
{
    const PRODUTO_STORE = [
        'nome'             => 'required|max:80',
        'descricao'        => 'required|max:200',
        'codBarras'        => 'required',
        'valor'            => 'required|numeric|gt:0'
    ];

    const CLIENTE_STORE = [
        'nome'          => 'required|max:80',
        'cpf'           => 'required|regex:/^[0-9]+$/',
        'email'         => 'required|string|email|max:255',
        'nascimento'    => 'required',        
        'telefone'      => 'required|string',
        'cep'           => 'nullable|string',
        'rua'           => 'nullable|string',
        'numero'        => 'nullable|string',
        'bairro'        => 'nullable|string',
        'uf'            => 'nullable|string',
        'cidade'        => 'nullable|string',
        'complemento'   => 'nullable|string',

    ];

    const PEDIDO_STORE = [
        'nome'          => 'required|max:80',
        'cpf'           => 'required|regex:/^[0-9]+$/',
        'email'         => 'required|string|email|max:255',
        'nascimento'    => 'required',        
        'telefone'      => 'required|string',
        'cep'           => 'nullable|string',
        'rua'           => 'nullable|string',
        'numero'        => 'nullable|string',
        'bairro'        => 'nullable|string',
        'uf'            => 'nullable|string',
        'cidade'        => 'nullable|string',
        'complemento'   => 'nullable|string',

    ];
}