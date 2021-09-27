@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm text-right">
                <a href="{{ route('produto.index')  }}"  class="btn btn-outline-primary"><i class="fas fa-back"></i> Voltar</a>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-offset-4 col-md-4">
                <div class="panel panel-default  container-fluid">
                    {!! Form::open(['route' => array('produto.update', $produto->id), 'method' => 'PUT']) !!}
            <div class="modal-body">                
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome?') }}
                    {{ Form::text('nome',  $produto->nome, ['class' => 'form-control', 'placeholder' => 'Ex. Macarrão'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('descricao', 'Descrição?') }}
                    {{ Form::textarea('descricao', $produto->descricao, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Ex. Pasta usada para acompanhamneto de refeição.']) }}
                </div> 
                <div class="form-group ">
                    {{ Form::label('codBarras', 'Código de Barras?') }}
                    {{ Form::text('codBarras',  $produto->codBarras, ['class' => 'form-control', 'placeholder' => 'Ex. 12312351434134', 'max-leng'] ) }}
                </div>           
                <div class="form-group">
                    {{ Form::label('valor', 'Valor?') }}
                    {{ Form::number('valor', $produto->valor, ['class' => 'form-control', 'placeholder' => 'Ex. R$30,00'] ) }}
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