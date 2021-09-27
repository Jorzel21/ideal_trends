@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm text-right">
                <a href="{{ route('cliente.index')  }}"  class="btn btn-outline-primary"><i class="fas fa-back"></i> Voltar</a>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-md-offset-4 col-md-4">
                <div class="panel panel-default  container-fluid">
                    {!! Form::open(['route' => array('cliente.update', $cliente->id), 'method' => 'PUT']) !!}
            <div class="modal-body">                
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome?') }}
                    {{ Form::text('nome',  $cliente->nome, ['class' => 'form-control', 'placeholder' => 'Ex. Macarrão'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cpf', 'CPF?') }}
                    {{ Form::text('cpf', $cliente->cpf, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33', 'disabled']) }}
                </div> 
                <div class="form-group ">
                    {{ Form::label('email', 'E-mail?') }}
                    {{ Form::text('email',  $cliente->email, ['class' => 'form-control', 'placeholder' => 'Ex. 12312351434134', 'max-leng'] ) }}
                </div>
                <div class="form-group">
                    {{ Form::label('nascimento', 'Data de nascimento?') }}
                    {{ Form::date('nascimento', $cliente->nascimento, ['class' => 'form-control', 'placeholder' => 'Ex. 21/12/1999']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('telefone', 'Telefone?') }}
                    {{ Form::text('telefone', $cliente->telefone, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div>   
                <div class="form-group">
                    {{ Form::label('cep', 'CEP?') }}
                    {{ Form::text('cep', $cliente->cep, ['class' => 'form-control cep', 'autocomplete' => 'off',  'placeholder' => 'Ex. 59000-000']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('rua', 'Rua?') }}
                    {{ Form::text('rua', $cliente->rua, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('numero', 'Número?') }}
                    {{ Form::text('numero', $cliente->numero, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 129']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('bairro', 'Bairro?') }}
                    {{ Form::text('bairro', $cliente->bairro, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. Sumaré']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('uf', 'Estado?') }}
                    {{ Form::text('uf', $cliente->uf, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. SP']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('cidade', 'Cidade?') }}
                    {{ Form::text('cidade', $cliente->cidade, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. São Paulo']) }}
                </div> 
                <div class="form-group">
                    {{ Form::label('complemento', 'Complemento?') }}
                    {{ Form::text('complemento', $cliente->complemento, ['class' => 'form-control', 'max-lenght' => '11', 'placeholder' => 'Ex. 001.233.333-33']) }}
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
    </script>
@endsection