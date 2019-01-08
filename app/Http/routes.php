<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

date_default_timezone_set("America/Sao_Paulo");

Route::get('/','MainController@index')->middleware('auth');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/model','ClientesController@index');

Route::get('/admin','HomeController@admin')->middleware(['auth','admin']);

Route::get('/envia','HomeController@envia');

Route::post('/recebe','HomeController@recebe');

//----------------------------------------------------------
Route::get("/painel","MainController@index")->name('home');

Route::group(['prefix' => 'projetos'], function ()
{
    Route::resource('novo','NovoProjetoController');

    Route::get('abertos','MainController@projetosAbertos')->name('projetosAbertos');

    Route::get('abertos/{id}','ProjetoController@index')->name('detalhesProjeto');

    Route::post('abertos/adicionar','ProjetoController@adicionarPeca')->name('adicionarPeca');

    Route::post('abertos/remover','ProjetoController@removerPeca')->name('removerPeca');

    Route::get('abertos/barcode/{id}','ProjetoController@gerarBarcode');

    Route::resource('orcamento','OrcamentoController');

    Route::get('fechados','MainController@projetosFechados');
});

Route::group(['prefix' => 'cadastro'], function ()
{
    Route::resource('maquina','MaquinasController');

    Route::resource('cliente','ClienteController');

    Route::resource('funcionario','FuncionarioController');
});

Route::resource('peca','PecaController');
