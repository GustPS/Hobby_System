<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class ProdutosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function listar()
    {
        $produtos = Produto::paginate(25);
        Paginator::useBootstrap();

        return view('produto.lista', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.formulario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/produtos');
        if ($request->hasfile('icone')) {
            $foto = $request->file('icone');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('icone')->getClientOriginalName();
            if ($miniatura->resize(
                500,
                500,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($pasta . '/' . $nomeArquivo)) {
                $nomeArquivo = "semfoto.jpg";
            }
        } else {
            $nomeArquivo = 'semfoto.jpg';
        }

        $produto = new Produto();
        $produto->fill($request->all());
        $produto->icone = $nomeArquivo;
        if ($produto->save()) {
            $request->session()->flash('mensagem_sucesso', "Produto salvo!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('produto/create');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produto.formulario', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto_id)
    {


        $produto = Produto::findOrFail($produto_id->id);
        $this->validate($request, ['image.*', 'mimes:jpeg, jpg, gif, png']);
        $pasta = public_path('/uploads/produtos');

        if ($request->hasfile('icone')) {
            $foto = $request->file('icone');
            $miniatura = Image::make($foto->path());
            $nomeArquivo = $request->file('icone')->getClientOriginalName();
            if (!$miniatura->resize(
                500,
                500,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            )->save($pasta . '/' . $nomeArquivo)) {
                $nomeArquivo = "semfoto.jpg";
            }
        } else {
            $nomeArquivo = $produto->icone;
        }
        $produto->fill($request->all());

        // $produto->icone = $nomeArquivo;
        if ($produto->save()) {
            $request->session()->flash('mensagem_sucesso', "Produto alterado!");
        } else {
            $request->session()->flash('mensagem_erro', 'Deu erro');
        }
        return Redirect::to('produto/' . $produto_id->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletar(Request $request, Produto $produto_id)
    {
        $produto = Produto::findOrFail($produto_id->id);
        $lOk = true;
        if (!empty($produto->icone)) {
            if ($produto->icone != 'semfoto.jpg') {
                $lOk = unlink(public_path('uploads/produtos/') . $produto->icone);
            }
        }
        if ($lOk) {
            $produto->delete();
            $request->session()->flash(
                'mensagem_sucesso',
                'Produto removido com sucesso'
            );
            return Redirect::to('produto');
        }
    }
    public function showReport()
    {
        $produtos = Produto::get();

        $imagem = 'uploads/produtos/semfoto.jpg';

        $produto = pathinfo($imagem, PATHINFO_EXTENSION);
        $data = file_get_contents($imagem);
        $base64 = base64_encode($imagem);
        $logo = 'data:image' . $produto . ';base64,' . $base64;

        //$logo = base64_encode(file_get_contents(public_path('/uploads/produto/semfoto.jpg')));


        $pdf = FacadePdf::loadView('reports.produtos', compact('produtos', 'logo'));

        $pdf->setPaper('a4', 'portrait')
            ->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif'])
            ->setEncryption('123');


        return $pdf
            //->download('relatorio.pdf');
            // ->save(public_path('/arquivos/relatorio.pdf'));
            ->stream('relatorio.pdf');
    }
}
