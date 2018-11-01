<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $teste = "Bom dia";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
      return "teste de middleware";
    }

    public function envia()
    {
      $teste = array('1','2','Thiago');
      return view('envia',compact('teste'));
    }

    public function recebe(Request $request)
    {
      $lista = unserialize($request->button);
      return view('recebe',compact('lista'));
    }

}
