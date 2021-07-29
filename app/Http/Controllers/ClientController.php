<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientRequest;
use App\Models\Client;
use App\Models\State;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Client $client)
    {
        $this->request = $request;
        $this->repository = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all('id', 'title');
        return view('admin.client.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClientRequest $request)
    {
        $data = $request->all();

        $notification = [
            'message' => 'Cadastrado com sucesso',
            'alert-type' => 'success',
        ];

        Client::create($data);

        return redirect()->route('dashboard.clientes.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $states = State::all('id', 'title');
        return view('admin.client.edit', compact('client', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateClientRequest $request, $id)
    {
        $client = $this->repository->where('id', $id)->first();

        $data = $request->all();

        $update = $client->update($data);

        $notify = [
            'alert-type' => 'success',
            'message' => 'Atualizado com sucesso',
        ];

        if ($update) {
            return redirect()->route('dashboard.clients.index')->with($notify);
        }

        return redirect()->back()->with('error', 'Falha ao atualizar o cliente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::findOrFail($id)->delete();

        $notify = [
            'alert-type' => 'success',
            'message' => 'Excluído com sucesso',
        ];

        return redirect()->route('dashboard.clientes.index')->with($notify);
    }
}
