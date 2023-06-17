<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header">
                <h1>Contatos</h1>
            </div>

            <div class="card-body">
                <p class="lead">Qual a sua duvida?</p>
                @if (Session::get('mensagem_sucesso'))
                    <div class="alert alert-sucess">
                        {{ Session::get('mensagem_sucesso') }}
                    </div>
                @endif
                {!! Form::open(['method' => 'POST', 'url' => 'contatos']) !!}
                <div class="form-group">
                    {!! Form::label('nome', 'Nome') !!}
                    {!! Form::input('text', 'nome', null, [
                        'class' => 'form-control',
                        'autofocus',
                        'placeholder' => 'Nome',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::input('text', 'email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fone', 'Telefone') !!}
                    {!! Form::input('text', 'fone', null, ['class' => 'form-control', 'placeholder' => 'Telefone', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('mensagem', 'Mensagem') !!}
                    {!! Form::textarea('mensagem', null, [
                        'class' => 'form-control',
                        'rows' => 5,
                        'placeholder' => 'Mensagem',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Enviar', ['class' => 'form-control btn btn-primary mt-2']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>

</body>

</html>
