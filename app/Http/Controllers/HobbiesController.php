<?php

namespace App\Http\Controllers;

use App\Models\Colecao;
use App\Models\Hobbie;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;

class HobbiesController extends Controller
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
        $hobbie = Hobbie::with('hobbie', 'colecao')->paginate(25);
        Paginator::useBootstrap();
        return view('hobbie.lista', compact('hobbie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hobbie.formulario');
        $colecoes = Colecao::select('nome', 'id')->pluck('nome', 'id');
        return view('hobbie.formulario', compact('colecoes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hobbie = new Hobbie();
        $hobbie->fill($request->all());
        if ($hobbie->save()) {
            $request->session()->flash('mensagem_sucesso', "Hobbies salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('hobbie/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hobbie $hobbie)
    {
        $hobbie = Hobbie::findOrFail($hobbie->id);
        $colecao = Colecao::select('nome', 'id')->pluck('nome', 'id');
        return view(
            'hobbie.formulario',
            compact('colecao')
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
    public function update(Request $request, Hobbie $hobbie_id)
    {
        $hobbie = Hobbie::findOrFail($hobbie_id);
        $hobbie->fill($request->all());
        if ($hobbie->save()) {
            $hobbie = 'mensagem_sucesso';
            $msg = 'Hobbie Salvo!';
        } else {
            $hobbie = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('hobbie/' . $hobbie_id)
            ->with($hobbie, $msg);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hobbie $hobbie)
    {
        $hobbie = Hobbie::findOrFail($hobbie->id);
        if ($hobbie->delete()) {
            $hobbie = 'mensagem_sucesso';
            $msg = 'Hobbie Removida!';
        } else {
            $hobbie = 'mensagem_sucesso';
            $msg = 'Deu erro!';
        }

        return Redirect::to('hobbie')
            ->with($hobbie, $msg);
    }
}
