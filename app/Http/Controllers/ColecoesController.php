<?php

namespace App\Http\Controllers;

use App\Models\Colecao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;


class ColecoesController extends Controller
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
        $colecoes = Colecao::with('user')->paginate(25);
        Paginator::useBootstrap();
        return view('colecao.lista', compact('colecoes'));
    }
    public function listar()
    {
        $colecoes = Colecao::with('user')->paginate(25);
        Paginator::useBootstrap();
        return view('colecao.lista', compact('colecoes
        '));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('name', 'id')->pluck('name', 'id');
        return view('colecao.formulario', compact('users'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $colecoes = new Colecao();
        $colecoes->fill($request->all());
        if ($colecoes->save()) {
            $request->session()->flash('mensagem_sucesso', "Colecão salva!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('colecao/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $colecoes = Colecao::findOrFail($id);
        $users = User::select('id',)->pluck('id');
        return view('colecao.formulario', compact('colecoes', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colecao $colecao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $colecoes_id)
    {

        $colecoes = Colecao::findOrFail($colecoes_id);
        $colecoes->fill($request->all());
        // dd($request->all());
        if ($colecoes->save()) {
            dd("Fiapooo");
            $request->session()->flash('mensagem_sucesso', "Coleção alterado!");
        } else {
            dd("erro");
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('colecao/' . $colecoes->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($colecoes_id)
    {

        $colecoes = Colecao::findOrFail($colecoes_id);
        if ($colecoes->delete()) {
            $colecoes = 'mensagem_sucesso';
            $msg = 'Coleção Removida!';
        } else {
            $colecoes = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('colecao')
            ->with($colecoes, $msg);
    }
}
