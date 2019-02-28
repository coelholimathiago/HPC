<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class PainelController extends Controller
{
    public function index()
    {
      return view('painel.main');
    }

    public function truncate($tabela)
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      DB::table($tabela)->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
      return back();
    }
}
