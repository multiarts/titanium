<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\State;
use App\Models\Client;
use App\Models\Agency;
use App\Models\Tecnico;
use App\Models\Chamados;
use App\Models\SubClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ChamadosController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Chamados $chamados)
    {
        // $this->middleware('auth');
        $this->request = $request;
        $this->repository = $chamados;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {                
        if (!empty($request->from_date)) {
            $chamados = $this->repository->whereBetween('start', [$request->from_date, $request->to_date])->get();
        } else {
            $chamados = $this->repository->all();
        }
        return view('admin.chamados.index', compact('chamados'));
    }

    public function getIndex(Request $request)
    {
        if (!empty($request->from_date)) {
            $chamados = $this->repository->whereBetween('start', [$request->from_date, $request->to_date])->get();
        } else {
            $chamados = $this->repository->all();
        }

        return view('admin.chamados.index', compact('chamados'));
    }

    public function show(Chamados $chamado)
    {
        return view('admin.chamados.show', compact('chamado'));
    }

    public function edit(Chamados $chamado)
    {
        $users = User::all()->pluck('name', 'id');
        $states = State::all()->pluck('title', 'id');
        $clients = Client::all()->pluck('name', 'id');
        $tecnicos = Tecnico::all('id', 'name', 'active');
        $agencies = Agency::all()->pluck('name', 'id');
        return view('admin.chamados.edit', compact('chamado', 'users', 'states', 'tecnicos', 'clients', 'agencies'));
    }

    public function byAnalista()
    {
        $userId = Auth::user()->id;
        $chamados = Chamados::where('user_id', $userId)->get();

        return view('analysts.index', compact('chamados'));
    }

    public function create()
    {
        $users = User::all()->pluck('name', 'id');
        $states = State::all()->pluck('title', 'id');
        $clients = Client::all()->pluck('name', 'id');
        $tecnicos = Tecnico::all('id', 'name', 'active');
        $agencies = Agency::all()->pluck('name', 'id');

        return view('admin.chamados.create', compact('users', 'states', 'tecnicos', 'clients', 'agencies'));
    }

    public function store(Request $request, Chamados $chamados)
    {
        $create = $request->except('_token');

        $create['improdutiva'] = $request->has('improdutiva') ? 'on' : 'off';
        $create['documentacao'] = $request->has('documentacao') ? 'on' : 'off';

        $notification = array(
            'message' => 'Chamado cadastrado com sucesso.',
            'alert-type' => 'success'
        );

        $chamados->create($create);

        return redirect(route('dashboard.chamados.index'))->with($notification);
    }

    public function update(Request $request, Chamados $chamados, $id)
    {
        $update = $request->except(['_token', '_method']);

        $notification = array(
            'message' => 'Chamado ' . $chamados->number . 'atualizado com sucesso.',
            'alert-type' => 'success'
        );

        $update['improdutiva'] = $request->has('improdutiva') ? 'on' : 'off';
        $update['documentacao'] = $request->has('documentacao') ? 'on' : 'off';

        $total = Chamados::where('id', $id)
            ->sum(
                DB::raw("v_atendimento + v_titanium + v_km + v_deslocamento")
            );

        $chamados->total = $total;
        // dd($chamados->total);

        if ($chamados->whereId($id)->update($update)) {
            request()->session()->flash('success', 'Chamado ' . $chamados->number . ' atualizado com sucesso.');
        } else {
            request()->session()->flash('error', 'Houve uma falha ao atualizar o usuário!');
        }

        return redirect(route('dashboard.chamados.index'))->with($notification);
    }

    public function destroy($id)
    {
        $notification = array(
            'message' => 'Excluído com sucesso.',
            'alert-type' => 'success'
        );
        //        dd($id);
        return redirect(route('dashboard.chamados.index'))->with($notification);
    }

    public function getSubClient($id)
    {
        $clients = Client::findOrFail($id);
        $subClient = $clients->subClient()->getQuery()->orderBy('id', 'ASC')->get(['id', 'client_id', 'name']);
        // dd($subClient);
        return json_decode($subClient);
    }

    public function getAgency($id)
    {
        $clients = SubClient::findOrFail($id);
        $subClient = $clients->subClient()->getQuery()->orderBy('id', 'ASC')->get(['id', 'client_id', 'name']);
        // dd($subClient);
        return json_decode($subClient);
    }

    public function abertos()
    {
        $chamados = Chamados::where('status', 0)->get();
        return view('admin.chamados.types.open', compact('chamados'));
    }

    public function concluido()
    {
        $chamados = Chamados::where('status', 1)->get();
        return view('admin.chamados.types.finished', compact('chamados'));
    }

    public function pendentes()
    {
        $chamados = Chamados::where('status', 2)->get();
        return view('admin.chamados.types.pending', compact('chamados'));
    }
}
