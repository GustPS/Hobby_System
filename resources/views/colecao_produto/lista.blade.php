@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de Coleções de Produtos
                        <a href="{{ url('colecao_produto/create') }}" class="btn btn-success btn-sm float-end">

                            Nova Coleção de produtos
                        </a>
                    </div>
                    <div class="card-body">
                        @if (Session::has('mensagem_sucesso'))
                            <div class="alert alert-success">
                                {{ Session::get('mensagem_sucesso') }}
                            </div>
                        @endif
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Coleção</th>
                                    <th>Produto</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($colecoes_produtos as $colecao_produto)
                                    <tr>
                                        <td>{{ $colecao_produto->id }}</td>

                                        <td>{{ $colecao_produto->colecao_id }}</td>

                                        <td>{{ $colecao_produto->produto_id }}</td>

                                        <td>
                                            <a href="{{ url('colecao_produto/' . $colecao_produto->id) }}"
                                                class="btn btn-primary btn-sm">

                                                Editar
                                            </a>

                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => 'colecao_produto/' . $colecao_produto->id,
                                                'style' => 'display:inline',
                                            ]) !!}

                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            Não há itens para listar!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            {{ $colecoes_produtos->links() }}





                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
