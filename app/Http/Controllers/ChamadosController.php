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

    public function __construct(Request $request, User $user)
    {
        // $this->middleware('auth');
        $this->request = $request;
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chamados = Chamados::all();
        $user = Auth::user();

        return view('admin.chamados.index', compact('chamados', 'user'));
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

        $notification = array(
            'message' => 'Chamado cadastrado com sucesso.',
            'alert-type' => 'success'
        );

        //        dd($create);

        $chamados->create($create);

        return redirect(route('dashboard.chamados.index'))->with($notification);
    }

    public function update(Request $request, Chamados $chamados, $id)
    {
        $notification = array(
            'message' => 'Chamado ' . $chamados->number . 'atualizado com sucesso.',
            'alert-type' => 'success'
        );

        $update = $request->except(['_token', '_method']);

        $update['produtiva'] = $request->has('produtiva') ? 'on' : 'off';
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

    public function filter(Request $request, $type)
    {
        $chamados = Chamados::where('type', $type);

        if ($request->has(0)) {
            $chamados->where('type', $request->type);
        }

        if ($request->has(1)) {
            $chamados->where('type', $request->type);
        }

        //    dd($chamados->get());

        $chamado = $chamados->get();

        return view('admin.chamados.filter', compact('chamado'));
    }

    public function cacete()
    {
        $myArray = Tecnico::all();

        $myCollectionObj = collect($myArray);

        $data = $this->paginate($myCollectionObj);
        $data->withPath('/filter');
        return view('admin.chamados.filter', compact('data'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function status($status)
    {
        $chamados = Chamados::where('status', $status);
        if($status==null) {
            return Chamados::all();
        }

        dd($chamados->get());
        return $chamados->get();
    }
    public function abertos()
    {
        $chamados = Chamados::where('status', 0)->get();

        // dd($chamados->get());
        // $chamados;

        return view('admin.chamados.types.open', compact('chamados'));
    }

    public function concluido()
    {
        $chamados = Chamados::where('status', 1)->get();

        // dd($chamados->get());
        return view('admin.chamados.types.finished', compact('chamados'));
    }

    public function pendentes()
    {
        $chamados = Chamados::where('status', 2)->get();

        // dd($chamados->get());
        return view('admin.chamados.types.pending', compact('chamados'));
    }

}
