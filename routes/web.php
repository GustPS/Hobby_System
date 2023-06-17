<?php

use App\Http\Controllers\Colecoes_ProdutosController;
use App\Http\Controllers\ColecoesController;
use App\Http\Controllers\comentariosController;
use App\Http\Controllers\ContatosController;
use App\Http\Controllers\HobbiesController;
use App\Http\Controllers\ProdutosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/produto', [ProdutosController::class, 'listar']);
Route::get('/produto/create', [ProdutosController::class, 'create'])->name('produto.create');
Route::get('/produto/report', [ProdutosController::class, 'ShowReport']);
Route::get('/produto/{produto_id}', [ProdutosController::class, 'show'])->name('produto.show');
Route::post('/produto', [ProdutosController::class, 'store']);
Route::patch('/produto/{produto_id}', [ProdutosController::class, 'update']);
Route::delete('/produto/{produto_id}', [ProdutosController::class, 'deletar']);
Route::resource('colecao', ColecoesController::class);
Route::resource('colecao_produto', Colecoes_ProdutosController::class);
Route::resource('hobbie', HobbiesController::class);
Route::resource('comentario', comentariosController::class);

Route::get('contatos', [ContatosController::class, 'index']);
Route::post('contatos', [ContatosController::class, 'enviar']);
