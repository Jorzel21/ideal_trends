@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm text-right">
                <a href="{{ route('pedido.index')  }}"  class="btn btn-outline-primary"><i class="fas fa-back"></i> Voltar</a>
            </div>
        </div>
    </div>
    @php
        $total = 0;
    @endphp
  
    <div class="row d-flex justify-content-center">
        <div class="col-md-offset-4 col-md-10">
                <div class="panel panel-default  container-fluid">
                    {!! Form::open(['route' => array('pedido.update', $pedido->id), 'method' => 'PUT']) !!}
        <div class="container">
            <div class="row">                
                <div class="col-md-4">
                    {{ Form::label('cliente', 'Cliente?') }}
                    {{ Form::select('cliente', $clientes, $pedido->cliente_id, ['class' => 'form-control', 'placeholder' => 'Selecione', 'disabled']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('status', 'Status?') }}
                    {{ Form::select('status', ['00' => 'Em aberto','01' => 'Pago', '02' => 'Cancelado' ], $pedido->status, ['class' => 'form-control', 'placeholder' => 'Selecione']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('atulizado', 'Atualizado em') }}
                    {{ Form::text('atulizado', \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->updated_at)->format('d/m/Y H:i:s'), ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
        </div>
        
        <div class="container pt-4">
            <div class="form-group">
                <h6 for="list" class="text-nowrap">Produtos adicionados</h6>
                <table class="table table-striped list">
                    <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Observação</th>
                        <th class="text-center">Quantidade</th>
                        <th class="text-center">Preço</th>
                        <th class="text-center">Preço Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $item)
                        <tr>                                  
                            <td class="text-left">{{ $item->id }}</td>
                            <td class="text-center">{{ $item->produto->nome}}</td>
                            <td class="text-center">{{ $item->obs }}</td>
                            <td class="text-center">{{ $item->quantidade }}</td>
                            <td class="text-center">{{ $item->produto->valor }}</td>
                            <td class="text-center">R$ {{ (float) ($item->quantidade* $item->produto->valor) }}</td>
                        </tr>
                        @php
                            $total += (float) ($item->quantidade* $item->produto->valor);    
                        @endphp
                        
                        @endforeach
                 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center text-bold">TOTAL: </td>
                            <td class="text-center">R$ {{$total}}</td>
                          </tr>
                    </tfoot>
                </table>               
            </div>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-dark">Salvar</button>
            </div>
            {!! Form::close() !!}
                </div>
            </div>
    </div>
</div>

@endsection