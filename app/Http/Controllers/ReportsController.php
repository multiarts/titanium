<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Chamados;
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

    public function byCity()
    {
        $city = City::all();
        $chamado = Chamados::all();

        return view('admin.reports.city.city', compact('chamado', 'city'));
    }

    public function cityName(City $city)
    {
        $chamado = Chamados::where('cite_id', $city->id)->get();
        $total = Chamados::where('cite_id', $city->id)
            ->sum(
                DB::raw("v_atendimento + v_titanium + v_km + v_deslocamento")
            );
        return view('admin.reports.city.city_name', compact('city', 'chamado', 'total'));
    }
}
