@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dados dos Coleções
                    <a href="{{ url('colecao') }}" class="btn btn-success btn-sm float-end">
                        Listar Coleções

                    </a>
                </div>
                <div class="card-body">
                    @if(Session::has('mensagem_sucesso'))
                    <div class="alert alert-success">
                        {{ Session::get('mensagem_sucesso') }}
                    </div>
                    @endif
                    @if(Session::has('mensagem_erro'))
                    <div class="alert alert-danger">
                        {{ Session::get('mensagem_erro') }}
                    </div>
                    @endif

                    @if(Route::is('colecao.show'))

                    {!! Form::model($colecoes,
                    ['method'=>'PATCH',
                    'url'=>'colecao/'.$colecoes->id]) !!}
                    @else
                    {!! Form::open(['method'=>'POST', 'url'=>'colecao']) !!}
                    @endif
                    {!! Form::label('user_id', 'Usuario') !!}
                    {!! Form::select('user_id',
                    $users,
                    null,
                    ['class' =>'form-control',
                    'placeholder' =>'Selecione o Usuario',
                    'required'])!!}


                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::input('text', 'nome',
                    null,
                    ['class'=>'form-control',
                    'placeholder'=>'Nome',
                    'required',
                    'maxlength'=>50,
                    'autofocus']) !!}

                    {!! Form::label('descricao', 'Descrição') !!}
                    {!! Form::input('text', 'descricao',
                    null,
                    ['class'=>'form-control',
                    'placeholder'=>'Descrição',
                    'required',
                    'maxlength'=>150]) !!}
                    {!! Form::submit('Salvar',
                    ['class'=>'float-end btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
