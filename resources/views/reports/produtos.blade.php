<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatórios de Produtos</title>
</head>
<body>
    <h1> Relatório de Produtos</h1>

    <hr>
    <table border="2" cellpadding='0' cellspacing="4" style="width: 100%" border="">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Icone</th>
        </tr>

        @forelse ($produtos as $produto )

        <tr>
            <td>{{ $produto->id }}</td>

            <td>{{ $produto->nome }}</td>

            <td>{{ $produto->descricao }}</td>

            <td>{{ $produto->preco }}</td>

            <td>{{ $produto->icone }}</td>

            <td>
                <img src="{{ $logo }}" alt="">
                <img src="{{ public_path('uploads/produtos/semfotto.jpg') }}">
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Nenhum Produto cadsatrado</td>
        </tr>
        @endforelse

    </table>
</body>
</html>
