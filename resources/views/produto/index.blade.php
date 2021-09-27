@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm text-right">            
                <button data-toggle="modal" data-target="#filtro" class="btn btn-outline-secondary"><i
                            class="fas fa-filter"></i> Filtro
                </button>
                <button data-toggle="modal" data-target="#adicionar" class="btn btn-outline-primary"><i
                    class="fas fa-plus"></i> Adicionar
                </button>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default  container-fluid">
                    <div class="panel-heading row">
                        <div class="col-xs-6">Produtos</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>                                
                                <th class="text-left"> @sortablelink('id','id')</th>
                                <th class="text-center">@sortablelink('nome','Nome')</th>
                                <th class="text-center">@sortablelink('descricao','Descrição')</th>
                                <th class="text-center">@sortablelink('codBarras','Código de Barras')</th>
                                <th class="text-center">@sortablelink('valor','Valor')</th>
                                <th></th>
                            </tr>
                            @foreach($produtos as $item)
                                <tr>                                  
                                    <td class="text-left">{{ $item->id }}</td>
                                    <td class="text-center">{{ $item->nome }}</td>
                                    <td class="text-center">{{ $item->descricao }}</td>
                                    <td class="text-center">{{ $item->codBarras }}</td>
                                    <td class="text-center">R$ {{ $item->valor }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('produto.edit', $item->id)  }}" class="btn btn-preto btn-sm"><i class="fas fa-search"></i></a>
                                        <a href="#" data-id={{$item->id}} class="btn btn-preto btn-sm delete" data-toggle="modal" data-target="#excluir"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {{ $produtos->appends(\Request::except('page'))->render() }}
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adicionar" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'produto.store', 'method' => 'POST']) !!}
            <div class="modal-body">                
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome?') }}
                    {{ Form::text('nome',  null, ['class' => 'form-control', 'placeholder' => 'Ex. Macarrão'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('descricao', 'Descrição?') }}
                    {{ Form::textarea('descricao', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Ex. Pasta usada para acompanhamneto de refeição.']) }}
                </div> 
                <div class="form-group ">
                    {{ Form::label('codBarras', 'Código de Barras?') }}
                    {{ Form::text('codBarras',  null, ['class' => 'form-control', 'placeholder' => 'Ex. 12312351434134', 'maxlength'=>'20'] ) }}
                </div>           
                <div class="form-group">
                    {{ Form::label('valor', 'Valor?') }}
                    {{ Form::text('valor', null , ['class' => 'form-control valor', 'placeholder' => 'Ex. R$30.00'] ) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-preto" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-preto">Adicionar</button>
            </div>
            {!! Form::close() !!}
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
            {!! Form::open(['route' => 'produto.index','id' => 'form-filtro', 'method' => 'GET']) !!}
            <div class="modal-body"> 
                <div class="form-group ">
                    {{ Form::label('id', 'Id?') }}
                    {{ Form::number('id', null, ['class' => 'form-control', 'placeholder' => 'Digite o id']) }}
                </div>               
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome?') }}
                    {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'João']) }}
                </div>
                <div class="form-group ">
                    {{ Form::label('valor', 'Valor?') }}
                    {{ Form::text('valor', null, ['class' => 'form-control valor', 'placeholder' => 'R$ 30', 'data-thousands' => '', 'data-decimal' => '.']) }}
                </div>
                <div class="form-group ">
                    {{ Form::label('codBarras', 'Código de Barras?') }}
                    {{ Form::text('codBarras', null, ['class' => 'form-control', 'placeholder' => '14009876532']) }}
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

<!-- Modal Excluir Prpduto-->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'produto.delete', 'method' => 'POST']) !!}
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <p>Tem certeza que deseja excluir este produto?</p>

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