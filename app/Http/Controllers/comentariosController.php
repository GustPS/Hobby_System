<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Hobbie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class comentariosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comentario = Comentario::with('colecao', 'produto')->paginate(25);
        Paginator::useBootstrap();
        return view('comentario.lista', compact('comentarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comentario.formulario');
        $users = User::select('nome', 'id')->pluck('nome', 'id');
        $hobbies = Hobbie::select('nome', 'id')->pluck('nome', 'id');
        return view('comentario.formulario', compact('users', 'hobbies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $comentario = new Comentario();
        $comentario->fill($request->all());
        if ($comentario->save()) {
            $request->session()->flash('mensagem_sucesso', "Comentario salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('comentario/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        $comentario = Comentario::findOrFail($comentario->id);
        $users = User::select('nome', 'id')->pluck('nome', 'id');
        $hobbies = Hobbie::select('nome', 'id')->pluck('nome', 'id');
        return view(
            'comentario.formulario',
            compact('users', 'hobbies')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario_id)
    {
        $comentario = Comentario::findOrFail($comentario_id);
        $comentario->fill($request->all());
        if ($comentario->save()) {
            $comentario = 'mensagem_sucesso';
            $msg = 'Comentario Salvo!';
        } else {
            $comentario = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('comentario/' . $comentario_id)
            ->with($comentario, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario_id)
    {
        $comentario = Comentario::findOrFail($comentario_id);
        if ($comentario->delete()) {
            $comentario = 'mensagem_sucesso';
            $msg = 'comentario Removido!';
        } else {
            $comentario = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('comentario')
            ->with($comentario, $msg);
    }
}
