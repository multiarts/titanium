<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chamados;
use App\Models\State;
use App\Models\Tecnico;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class TecnicosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tecnicos = Tecnico::all();
        return view('admin.tecnicos.index', compact('tecnicos'));
    }

    public function show(Tecnico $tecnico)
    {
        $chamados = Chamados::where('tecnico_id', $tecnico->id)->get();
        // dd($chamados);
        return view('admin.tecnicos.show', compact('tecnico', 'chamados'));
    }

    public function create()
    {
        $estado = State::all()->pluck('letter', 'id');
        return view('analistas.tecnicos.create', compact('estado'));
    }

    public function edit(Tecnico $tecnico)
    {
        $estado = State::all()->pluck('title', 'id');

        return view('admin.tecnicos.edit', compact('tecnico', 'estado'));
    }

    public function store(Request $request, Tecnico $tecnico)
    {
        // dd($request->all());
        $create = $request->all();

        $tecnico->create($create);

        $notification = array(
            'message' => 'Técnico cadastrado com sucesso!',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard.tecnicos.index')->with($notification);
    }

    public function ajaxpost(Request $request, Tecnico $tecnico)
    {
        $input = $request->all();
        $tecnico->create($input);

        return response()->json(['success' => 'Técnico cadastrado com sucesso!']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tecnicos  $tecnicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email'
            ],
            'rg' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'telefone1' => 'required',
            'address' => 'required',
            'state_id' => 'required',
            'cities_id' => 'required',
            'agencia' => 'required',
            'numconta' => 'required',
            'numbanco' => 'required',
            'operacao' => 'required',
            'favorecido' => 'required',
            'tipo' => 'required',
            'active' => 'required',
        ]);

        $notification = array(
            'message' => 'Utualizado com sucesso.',
            'alert-type' => 'success'
        );

        // dd($inputs);

        if (Tecnico::whereId($id)->update($inputs)) {
            request()->session()->flash('success', 'Usuário atualizado com sucesso.');
        } else {
            request()->session()->flash('error', 'Houve uma falha ao atualizar o usuário!');
        }

        return redirect()->route('dashboard.tecnicos.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tecnicos  $tecnicos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $tecnicos->chamado()->detach();
        Tecnico::findOrFail($id)->delete();

        return redirect()->route('dashboard.tecnicos.index');
    }

    public function getCidades($idEstado)
    {
        $estado = State::find($idEstado);
        $cidades = $estado->cities()->getQuery()->orderBy('id', 'ASC')->get(['id', 'state_id', 'title']);
        // dd($cidades);
        return json_decode($cidades);
    }

    public function getTecnicos()
    {
        $tecnicos = Tecnico::getQuery()->orderBy('id', 'ASC')->get(['id', 'id', 'name', 'active']);
        // dd($tecnicos);
        return json_decode($tecnicos);

    }
}
