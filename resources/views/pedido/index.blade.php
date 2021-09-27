@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm text-right">            
                <button data-toggle="modal" data-target="#filtro" class="btn btn-outline-secondary"><i
                            class="fas fa-filter"></i> Filtro
                </button>
                <a href="{{ route('pedido.create')  }}" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Adicionar</a>           
            </div>
        </div>
    </div>

    
            <div class="col-md-12">
                <div class="panel panel-default  container-fluid">
                    <div class="panel-heading row">
                        <div class="col-xs-6 bold">Pedidos</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>                                
                                <th class="text-left"> @sortablelink('id','id')</th>
                                <th class="text-center">@sortablelink('cliente','Cliente')</th>
                                <th class="text-center">@sortablelink('status','Status')</th>
                                <th></th>
                            </tr>
                            @foreach($pedidos as $item)
                                <tr>                                  
                                    <td class="text-left">{{ $item->id }}</td>
                                    <td class="text-center"><a href="{{ route('cliente.edit', $item->cliente->id)  }}" class="btn btn-preto btn-sm"> {{ $item->cliente->nome }}</td>
                                    <td class="text-center">{{ $item->status }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('pedido.edit', $item->id)  }}" class="btn btn-preto btn-sm"><i class="fas fa-search"></i></a>
                                        <a href="#" data-id={{$item->id}} class="btn btn-preto btn-sm delete" data-toggle="modal" data-target="#excluir"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {{ $pedidos->appends(\Request::except('page'))->render() }}
                    </div>
                </div>
            </div>
    
</div>

<!-- Modal -->
<div class="modal fade" id="filtro" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filtro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'pedido.index','id' => 'form-filtro', 'method' => 'GET']) !!}
            <div class="modal-body"> 
                <div class="form-group ">
                    {{ Form::label('id', 'Id?') }}
                    {{ Form::number('id', null, ['class' => 'form-control', 'placeholder' => 'Digite o id']) }}
                </div>               
                <div class="form-group ">
                    {{ Form::label('cliente_id', 'Cliente?') }}
                    {{ Form::select('cliente_id', $clientes, null, ['class' => 'form-control', 'placeholder' => 'Selecione']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('status', 'Status?') }}
                    {{ Form::select('status', ['00' => 'Em aberto','01' => 'Pago', '02' => 'Cancelado' ], null, ['class' => 'form-control', 'placeholder' => 'Selecione']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('toDate', 'De Data?') }}
                    {{ Form::date('toDate', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('fromDate', 'Até Data?') }}
                    {{ Form::date('fromDate', null, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-preto" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-preto">Filtrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal Excluir Pedido-->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'pedido.delete', 'method' => 'POST']) !!}
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <p>Tem certeza que deseja excluir este cliente?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Não</button>
                <button type="submit" class="btn btn-outline-secondary">Sim, quero excluir</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection 


@section('js')
    <script>
        $(document).on('click','.delete',function(){
            const id = $(this).attr('data-id');
            $('#excluir #id').val(id);
       }); 
    </script>
@endsection
