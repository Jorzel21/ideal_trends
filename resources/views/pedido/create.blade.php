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
  
    <div class="row d-flex justify-content-center">
        <div class="col-md-offset-4 col-md-10">
                <div class="panel panel-default  container-fluid">
                    {!! Form::open(['route' => array('pedido.store'), 'method' => 'POST']) !!}
        <div class="container">
            <div class="row">                
                <div class="form-group ">
                    {{ Form::label('cliente', 'Cliente?') }}
                    {{ Form::select('cliente', $clientes, null, ['class' => 'form-control', 'placeholder' => 'Selecione']) }}
                </div>
            </div>
        </div>
            <div class="container">
            <div class="row">                
                    <div class="col-md-4">
                        {{ Form::label('produto', 'Produto?') }}
                        {{ Form::select('produto', $produtos, null, ['class' => 'form-control', 'id'=>'produto', 'placeholder' => 'Selecione']) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('quantidade', 'quantidade?') }}
                        {{ Form::number('quantidade',  null, ['class' => 'form-control', 'placeholder' => '10'] ) }}
                    </div>
                    <div class="col-md-4">
                        {{ Form::label('obs', 'Observação?') }}
                        {{ Form::text('obs',  null, ['class' => 'form-control', 'placeholder' => 'Ex. Vermelho'] ) }}
                    </div>
                    <div class="col-md-2">
                        <div class="input-group-append">
                            <button type="button" onclick="addProduto()" class="btn btn-outline-dark">Adcionar</button>
                          </div>
                    </div>
                </div>
            
            <input type="hidden" name="produtosAdd" id="produtosAdd">
            <div class="form-group pt-5">
                <label for="list">Produtos adicionados</label>
                <table class="table table-striped list">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Observação</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Preço Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
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

@section('js')
    <script type="text/javascript">
        function addProduto(){
            var array = [];
            $.ajax({
                'url':'{{ route('produto.get') }}/' +  $('#produto').val(),
                'success': function (response) {                   
                   var obj = {
                       produto: response,
                       quantidade:  $('#quantidade').val(),
                       obs:  $('#obs').val()
                   };
                   var arrayExistente = $('#produtosAdd').val();
                   if(arrayExistente == undefined || arrayExistente.trim() == ''){
                    array.push(obj)
                    $('#produtosAdd').val(JSON.stringify(array));
                   }else{
                    arrayExistente= JSON.parse(arrayExistente);                    
                    arrayExistente.push(obj);
                    $('#produtosAdd').val(JSON.stringify(arrayExistente));
                   }
                    $('#quantidade').val('');
                    $('#obs').val('');
                    $('#produto').val('');
                   montarLista($('#produtosAdd').val());
                }
            });
        }
        function montarLista(lista){
            let bodyList = $('.list').find('tbody');
            $('.list #trAppend').remove();
            const obj = JSON.parse(lista);
            obj.forEach(function(item, key){
                bodyList.append(`<tr id="trAppend">
                    <td>                        
                        `+key+`
                    </td>
                    <td> `+item.produto.nome+` </td>                
                    <td> `+item.obs+`</td>
                    <td> `+item.quantidade+`</td>
                    <td> R$ `+item.produto.valor+`</td>
                    <td> R$ `+(item.quantidade* item.produto.valor)+`</td>
                    </tr>
                `);
            });         
        }
    </script>
@endsection