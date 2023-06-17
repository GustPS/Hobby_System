<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContatosController extends Controller
{
    public function index()
    {
        return view('public_view.contato');
    }

    public function enviar(Request $request)
    {
        $dest_nome = "Gustavo";
        $dest_email = "gustavro33@gmail.com";
        $dados = array(
            'nome' => $request['nome'],
            'enail' => $request['email'],
            'fone' => $request['fone'],
            'mensagem' => $request['mensagem']
        );
        Mail::send(
            'email.contato',
            $dados,
            function ($mensagem) use ($dest_nome, $dest_email, $request) {
                $mensagem->to($dest_email, $dest_nome)
                    ->subject('E-mail do site Famper!')
                    ->bcc(['gustavro33@gmail.com', 'gustavro33@gmail.com']);
                $mensagem->from($request['email'], $request['nome']);
            }
        );
        return Redirect::to('contatos')
            ->with('mensagem-sucesso', 'E-mail enviado com sucesso!');
    }
}
