<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\State;
use App\Models\SubClient;
use Illuminate\Http\Request;

class SubclientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subclient = SubClient::all();
        return view('admin.subclient.index', compact('subclient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::all('id', 'name');
        $states = State::all('id', 'title');
        return view('admin.subclient.create', compact('states', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $notification = [
            'message' => 'Cadastrado com sucesso',
            'alert-type' => 'success',
        ];

        SubClient::create($data);

        return redirect()->route('dashboard.subclientes.index')->with($notification);
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
        $subclient = SubClient::findOrFail($id);
        $client = Client::all('id', 'name');
        $states = State::all('id', 'title');
        return view('admin.subclient.edit', compact('subclient', 'states', 'client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubClient::findOrFail($id)->delete();

        $notify = [
            'alert-type' => 'success',
            'message' => 'Excluído com sucesso',
        ];

        return redirect()->route('dashboard.subclientes.index')->with($notify);
    }
}
