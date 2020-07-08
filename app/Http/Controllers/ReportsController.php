<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\City;
use App\Models\Chamados;
use App\Models\Client;
use App\Models\SubClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.city');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function byCity(Request $request)
    {
        $month = $request->month;
        $status = $request->status;

        if (!empty($request->month)) {
            $chamado = Chamados::whereMonth('start', $request->month)
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->get();
                
        } else {
            $chamado = Chamados::get();            
        }
        $city = City::all();
        // $chamado = Chamados::all();

        return view('admin.reports.city.city', compact('chamado', 'city', 'month'));
    }

    public function cityName(Request $request, City $city)
    {
        $month = $request->month;
        $status = $request->status;

        if (!empty($request->month)) {
            $chamado = Chamados::where('cite_id', $city->id)
                ->whereMonth('start', $request->month)
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })
                ->get();
                
        } else {
            $chamado = Chamados::where('cite_id', $city->id)->get();            
        }

        $total = Chamados::where('cite_id', $city->id)
            ->value(DB::raw('SUM(total)'));

        return view('admin.reports.city.city_name', compact('city', 'chamado', 'total', 'month'));
    }

    public function client()
    {
        $client = Client::all();
        $chamado = Chamados::all();

        return view('admin.reports.client.client', compact('chamado', 'client'));
    }

    public function clientName(Client $client)
    {
        $chamado = Chamados::where('client_id', $client->id)->get();
        $total = Chamados::where('client_id', $client->id)
            ->value(DB::raw('SUM(total)'));
        return view('admin.reports.client.client_name', compact('client', 'chamado', 'total'));
    }

    public function subclient()
    {
        $subclient = SubClient::all();
        $chamado = Chamados::all();

        return view('admin.reports.subclient.subclient', compact('chamado', 'subclient'));
    }

    public function subclientName(SubClient $subclient)
    {
        $chamado = Chamados::where('sub_client_id', $subclient->id)->get();
        $total = Chamados::where('sub_client_id', $subclient->id)
            ->value(DB::raw('SUM(total)'));
        return view('admin.reports.subclient.subclient_name', compact('subclient', 'chamado', 'total'));
    }

    public function agency()
    {
        $agency = Agency::all();
        $chamado = Chamados::all();

        return view('admin.reports.agency.agency', compact('chamado', 'agency'));
    }

    public function agencyName(Chamados $prefixo, Request $request)
    {
        $month = $request->month;
        $status = $request->status;

        if (!empty($request->month)) {
            $chamado = Chamados::whereMonth('created_at', $request->month)
                ->where('prefix', $prefixo->prefix)
                ->when($status, function ($query, $status) {
                    return $query->where('status', $status);
                })->get();

            dd($month);
        } else {
            $chamado = Chamados::get();
        }


        // $chamado = Chamados::where('prefixo', $prefixo->prefixo)->get();
        $total = Chamados::where('prefix', $prefixo->prefix)
            ->value(DB::raw('SUM(total)'));

        return view('admin.reports.agency.agency_name', compact('chamado', 'total', 'month'));
    }
}
