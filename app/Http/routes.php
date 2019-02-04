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

//----------------------------------------------------------
Route::get("/","MainController@index")->name('home');

Route::group(['prefix' => 'projetos'], function ()
{
    Route::resource('novo','NovoProjetoController');

    Route::get('abertos','MainController@projetosAbertos')->name('projetosAbertos');

    Route::get('abertos/{id}','ProjetoController@index')->name('detalhesProjeto');

    Route::post('abertos/adicionar','ProjetoController@adicionarPeca')->name('adicionarPeca');

    Route::post('abertos/remover','ProjetoController@removerPeca')->name('removerPeca');

    Route::get('abertos/barcode/{id}','ProjetoController@gerarBarcode');

    Route::get('orcamento/{id}','OrcamentoController@index')->name('orcamento');

    Route::post('orcamento/salvar','OrcamentoController@salvar')->name('salvarOrcamento');

    Route::get('abertos/finalizar/{id}','ProjetoController@finalizar')->name('finalizarProjeto');

    Route::get('abertos/reiniciar/{id}','ProjetoController@reiniciar')->name('reiniciarProjeto');

    Route::get('fechados','MainController@projetosFechados');

    Route::get('aguardando','MainController@projetosAguardando');
});

Route::group(['prefix' => 'cadastro'], function ()
{
    Route::resource('maquina','MaquinasController');

    Route::resource('cliente','ClienteController');

    Route::resource('funcionario','FuncionarioController');

    Route::resource('centrocusto','CentroCustoController');
});

Route::resource('peca','PecaController');

Route::get('rastreamento','RastreamentoController@index');

Route::any('rastreamento/busca','RastreamentoController@busca')->name('buscaRastreamento');

Route::post('rastreamento/iniciar','RastreamentoController@iniciar')->name('iniciaRastreamento');

Route::post('rastreamento/finalizar','RastreamentoController@finalizar')->name('finalizaRastreamento');

Route::post('rastreamento/reiniciar','RastreamentoController@reiniciar')->name('reiniciaRastreamento');
