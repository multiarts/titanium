<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Tecnico;
use App\Models\Chamados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\TecnicoRequest;
use Illuminate\Support\Facades\Storage;

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
        $tecnicos = $this->repository->all();
        $chamados = Chamados::all('tecnico_id');

        return view('admin.tecnicos.index', compact('tecnicos', 'chamados'));
    }

    public function show(Tecnico $tecnico)
    {
        $chamados = Chamados::where('tecnico_id', $tecnico->id)->get();
        $total = Chamados::where('tecnico_id', $tecnico->id)
            ->sum(
                DB::raw("v_atendimento + v_titanium + v_km + v_deslocamento")
            );
        // dd($chamados);
        return view('admin.tecnicos.show', compact('tecnico', 'chamados', 'total'));
    }

    public function create()
    {
        $tecnico = new $this->repository;
        $estado = State::all()->pluck('letter', 'id');
        return view('admin.tecnicos.create', compact('estado', 'tecnico'));
    }

    public function edit($tecnico)
    {
        $tecnico = $this->repository->findOrFail($tecnico);
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
            'message' => 'Atualizado com sucesso.',
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
        try
        {
            // Tecnico::findOrFail($id)->delete();
        $tecnico = $this->repository->where('id', $id)->first();

        $notify = array(
            'message' => 'Este Técnico possui chamados atribuídos a ele e não pode ser excluído.',
            'alert_type' => 'danger'
        );

        if(count($tecnico->chamados))
        {
            return redirect()->route('dashboard.tecnicos.index')->with($notify);
        }

        $notification = array(
            'message' => 'Excluído com sucesso.',
            'alert_type' => 'success'
        );       
        
        
        if (!$tecnico)
        return redirect()->route('dashboard.tecnicos.index')->with($notification);
        
        if ($tecnico->image && Storage::exists($tecnico->image)) {
            Storage::delete($tecnico->image);
        }
        
        $tecnico->chamados()->detach(); 
        $tecnico->delete();

        return redirect()->route('dashboard.tecnicos.index')->with($notification);
        }
        catch (\Exception $e)
        {
            dd($e->getMessage());
        }
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
