@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Dados dos Coleções
                        <a href="{{ url('colecao_produto') }}" class="btn btn-success btn-sm float-end">
                            Listar Coleções

                        </a>
                    </div>
                    <div class="card-body">
                        @if (Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        @if (Session::has('mensagem_erro'))
                            <div class="alert alert-danger">
                                {{ Session::get('mensagem_erro') }}
                            </div>
                        @endif

                        @if (Route::is('colecao_produto.show'))
                            {!! Form::model($colecoes_produtos, ['method' => 'PATCH', 'url' => 'colecao_produto/' . $colecoes_produtos->id]) !!}
                        @else
                            {!! Form::open(['method' => 'POST', 'url' => 'colecao_produto']) !!}
                        @endif

                        {!! Form::label('colecao_id', 'Coleção') !!}
                        {!! Form::select('colecao_id', $colecoes, null, [
                            'class' => 'form-control',
                            'placeholder' => 'Selecione a Coleção',
                            'required',
                        ]) !!}
                        {!! Form::label('produto_id', 'Produtos') !!}
                        {!! Form::select('produto_id', $produtos, null, [
                            'class' => 'form-control',
                            'placeholder' => 'Selecione o Produto',
                            'required',
                        ]) !!}

                        {!! Form::submit('Salvar', ['class' => 'float-end btn btn-primary mt-3']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
