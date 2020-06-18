<?php

namespace App\Http\Controllers;

use App\Models\Chamados;
use App\Models\Tecnico;
use App\User;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(7);
        $tecnicos = Tecnico::all();
        $chamados = Chamados::orderBy('id', 'desc')->paginate(6);

        return view('admin.dashboard', compact('users', 'tecnicos', 'chamados'));
    }
}
