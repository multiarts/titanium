<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Tecnico;
use App\Models\Chamados;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TecnicoRequest;
use Illuminate\Support\Facades\Storage;
use PDF;

class TecnicosController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Tecnico $tecnico)
    {
        // $this->middleware('auth');
        $this->request = $request;
        $this->repository = $tecnico;
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
        return view('admin.tecnicos.create', compact('estado'));
    }

    public function edit(Tecnico $tecnico)
    {
        $estado = State::all()->pluck('title', 'id');

        return view('admin.tecnicos.edit', compact('tecnico', 'estado'));
    }

    public function store(TecnicoRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->has('active') ? 'on' : 'off';

        if ($request->hasFile('image') && $request->image->isValid()) {

            $imagePath = $request->image->store('tecnicos');

            $data['image'] = $imagePath;
        }

        // dd($data);

        $this->repository->create($data);

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
    public function update(TecnicoRequest $request, $id)
    {

        $tecnico = $this->repository->where('id', $id)->first();

        $data = $request->all();

        $data['active'] = $request->has('active') ? 'on' : 'off';

        if ($request->hasFile('image') && $request->image->isValid()) {
            // dd($request->image->store('tecnicos'));
            if ($tecnico->image && Storage::exists($tecnico->image)) {
                Storage::delete($tecnico->image);
            }
            $imagePath = $request->image->store('tecnicos');
            $data['image'] = $imagePath;
        }

        $notification = array(
            'message' => 'Utualizado com sucesso.',
            'alert_type' => 'success'
        );
        // dd($tecnico);
        $tecnico->update($data);
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
        // Tecnico::findOrFail($id)->delete();

        $tecnico = $this->repository->where('id', $id)->first();
        if (!$tecnico)
            return redirect()->back();

        if ($tecnico->image && Storage::exists($tecnico->image)) {
            Storage::delete($tecnico->image);
        }

        $tecnico->delete();

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

    public function pdf($id)
    {
        $tecnico = Chamados::findOrFail($id);
        $pdf = PDF::loadView('admin.tecnicos.pdf', compact('tecnico'))->stream('tecnico.pdf');

        return $pdf;
    }

    public function pdfGeneral($id)
    {
        $tecnico = Tecnico::findOrFail($id);
        $chamados = Chamados::where('tecnico_id', $tecnico->id)->get();
        $pdf = PDF::loadview('admin.tecnicos.pdfGeneral', compact('tecnico', 'chamados'))->stream($tecnico->name . '_tecnico.pdf');
        return $pdf;
    }
}
