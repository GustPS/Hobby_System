<?php

namespace App\Http\Controllers;

use App\Models\Colecao;
use App\Models\Colecao_Produto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class Colecoes_ProdutosController extends Controller
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
        $colecoes_produtos = Colecao_Produto::with('colecao', 'produto')->paginate(25);
        Paginator::useBootstrap();
        return view('colecao_produto.lista', compact('colecoes_produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colecoes = Colecao::select('nome', 'id')->pluck('nome', 'id');
        $produtos = Produto::select('nome', 'id')->pluck('nome', 'id');
        return view('colecao_produto.formulario', compact('colecoes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $colecao_Produto = new Colecao_Produto();
        $colecao_Produto->fill($request->all());
        if ($colecao_Produto->save()) {
            $request->session()->flash('mensagem_sucesso', "Coleções de Produtos salva!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('colecao_produto/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($colecao_Produto_id)
    {
        $colecao_Produto = Colecao_Produto::findOrFail($colecao_Produto_id);
        $colecoes = Colecao::select('nome', 'id')->pluck('nome', 'id');
        $produtos = Produto::select('nome', 'id')->pluck('nome', 'id');
        return view(
            'colecao_produto.formulario',
            compact('produtos', 'colecoes')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colecao_Produto $colecao_Produto)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Colecao_Produto $colecao_Produto_id)
    {
        $colecao_Produto = Colecao_Produto::findOrFail($colecao_Produto_id);
        $colecao_Produto->fill($request->all());
        if ($colecao_Produto->save()) {
            $colecao_Produto = 'mensagem_sucesso';
            $msg = 'Coleção_Produto Salva!';
        } else {
            $colecao_Produto = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('colecao_produto/' . $colecao_Produto_id)
            ->with($colecao_Produto, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colecao_Produto $colecao_Produto)
    {
        $colecao_Produto = Colecao_Produto::findOrFail($colecao_Produto->id);
        if ($colecao_Produto->delete()) {
            $colecao_Produto = 'mensagem_sucesso';
            $msg = 'Coleção de Produtos Removida!';
        } else {
            $colecao_Produto = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('colecao_produto')
            ->with($colecao_Produto, $msg);
    }
}
