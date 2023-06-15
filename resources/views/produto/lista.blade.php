@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Produtos
                    <a href="{{ url('produto/create') }}" class="btn btn-success btn-sm float-end">
                        Novo Produto
                    </a>
                </div>
                <div class="card-body">
                    @if(Session::has('mensagem_sucesso'))
                    <div class="alert alert-success">
                        {{ Session::get('mensagem_sucesso') }}
                    </div>
                    @endif
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>descrição</th>
                                <th>preco</th>
                                <th>Icone</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->preco }}</td>
                                <td>{{ $produto->icone }}</td>
                                <td>
                                    <a href="{{ url('produto/' . $produto->id) }}" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>

                                    {!! Form::open(['method' => 'DELETE', 'url' => 'produto/' . $produto->id, 'style' => 'display:inline']) !!}

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
                        {{ $produtos->links() }}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('produto/report') }}" target="_blank" class="btn btn-sm btn-warning ">
                        Relatório
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
