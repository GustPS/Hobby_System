@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Coleções
                    <a href="{{ url('colecao/create') }}" class="btn btn-success btn-sm float-end">
                        Nova Coleção
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
                                <th>Usuario</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colecoes as $colecao)
                            <tr>
                                <td>{{ $colecao->id }}</td>



                                <td>{{ $colecao->user_id }}</td>



                                <td>{{ $colecao->nome }}</td>



                                <td>{{ $colecao->descricao }}</td>



                                <td>
                                    <a href="{{ url('colecao/' . $colecao->id) }}" class="btn btn-primary btn-sm">

                                        Editar
                                    </a>

                                    {!! Form::open(['method' => 'DELETE', 'url' => 'colecao/' . $colecao->id, 'style' => 'display:inline']) !!}





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
                        {{ $colecoes->links() }}



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
