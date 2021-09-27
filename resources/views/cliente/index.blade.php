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
                        <div class="col-xs-6">Clientes</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <tr>                                
                                <th class="text-left"> @sortablelink('id','id')</th>
                                <th class="text-center">@sortablelink('nome','Nome')</th>
                                <th class="text-center">@sortablelink('cpf','CPF')</th>
                                <th class="text-center">@sortablelink('email','E-mail')</th>
                                <th class="text-center">@sortablelink('nascimento','Nascimento')</th>
                                <th></th>
                            </tr>
                            @foreach($clientes as $item)
                                <tr>                                  
                                    <td class="text-left">{{ $item->id }}</td>
                                    <td class="text-center">{{ $item->nome }}</td>
                                    <td class="text-center">{{ $item->cpf }}</td>
                                    <td class="text-center">{{ $item->email }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->nascimento)->format('d/m/Y') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('cliente.edit', $item->id)  }}" class="btn btn-preto btn-sm"><i class="fas fa-search"></i></a>
                                        <a href="#" data-id={{$item->id}} class="btn btn-preto btn-sm delete" data-toggle="modal" data-target="#excluir"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="text-center">
                        {{ $clientes->appends(\Request::except('page'))->render() }}
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
                <h5 class="modal-title">Adicionar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'cliente.store', 'method' => 'POST']) !!}
            <div class="modal-body">                
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome?') }}
                    {{ Form::text('nome',  null, ['class' => 'form-control', 'placeholder' => 'Ex. Macarrão'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cpf', 'CPF?') }}
                    {{ Form::text('cpf', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div> 
                <div class="form-group ">
                    {{ Form::label('email', 'E-mail?') }}
                    {{ Form::text('email',  null, ['class' => 'form-control', 'placeholder' => 'Ex. 12312351434134', 'max-leng'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('nascimento', 'Data de nascimento?') }}
                    {{ Form::date('nascimento', null, ['class' => 'form-control', 'placeholder' => 'Ex. 21/12/1999']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('telefone', 'Telefone?') }}
                    {{ Form::text('telefone', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('cep', 'CEP?') }}
                    {{ Form::text('cep', null, ['class' => 'form-control cep', 'autocomplete' => 'off',  'placeholder' => 'Ex. 59000-000']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('rua', 'Rua?') }}
                    {{ Form::text('rua', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('numero', 'Número?') }}
                    {{ Form::text('numero', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 129']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('bairro', 'Bairro?') }}
                    {{ Form::text('bairro', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. Sumaré']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('uf', 'Estado?') }}
                    {{ Form::text('uf', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. SP']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cidade', 'Cidade?') }}
                    {{ Form::text('cidade', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. São Paulo']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('complemento', 'Complemento?') }}
                    {{ Form::text('complemento', null, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div>               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-preto" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-preto">Criar</button>
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
            {!! Form::open(['route' => 'cliente.index','id' => 'form-filtro', 'method' => 'GET']) !!}
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
                    {{ Form::label('cpf', 'CPF?') }}
                    {{ Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => '14009876532']) }}
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

<!-- Modal Excluir Cliente-->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'cliente.delete', 'method' => 'POST']) !!}
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Cliente</h5>
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
    <script type="text/javascript">
        $(".cep").on('keyup', function () {
            var cep = $(this).val().replace('-', '').replace('_', '');
            if (cep.length == 8) {
                $.ajax({
                    'url': 'https://viacep.com.br/ws/' + cep + '/json/',
                    'success': function (endereco) {
                        if (typeof endereco.erro === 'undefined') {
                            $("#rua").val(endereco.logradouro);
                            $("#bairro").val(endereco.bairro);
                            $("#numero").val('');
                            $("#uf").val(endereco.uf).trigger('change');
                            $("#cidade").val(endereco.localidade);
                            $("#numero").focus();
                        }
                    }
                });
            }
            else{
                $("#rua").val('');
                $("#bairro").val('');
                $("#numero").val('');
                $("#cidade").val('');
                $("#uf").val('');
            }
        });
        $(document).on('click','.delete',function(){
            const id = $(this).attr('data-id');
            $('#excluir #id').val(id);
       }); 
    </script>
@endsection