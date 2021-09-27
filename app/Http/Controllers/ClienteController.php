<?php

namespace App\Http\Controllers;

use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $clienteService;

    /**
     * Create a new controller instance.
     *
     * @param ClienteService $clienteService
     */
    public function __construct(
        ClienteService $clienteService
    ) {
        $this->clienteService   = $clienteService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        try {
            $clientes = $this->clienteService->index($request);
            return view('cliente.index', compact('clientes'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash($e->getMessage())->error();
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
            $this->clienteService->store($request);
            flash('Cliente adicionado com sucesso!')->success();
            return redirect()->route('cliente.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Cliente não existe')->error();
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
            $cliente = $this->clienteService->get($id);
            return view('cliente.edit', compact('cliente'));
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Cliente não encontrado!')->error();
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
            $this->clienteService->update($id, $request);
            flash('Cliente atualizado com sucesso!')->success();
            return redirect()->route('cliente.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Cliente não existe')->error();
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
            $this->clienteService->destroy($request->id);
            flash('Cliente excluído com sucesso!')->success();
            return redirect()->route('cliente.index');
        } catch (\Exception $e) {
            info($e->getMessage());
            flash('Cliente não existe')->error();
            return redirect()->back();
        }
    }
}
