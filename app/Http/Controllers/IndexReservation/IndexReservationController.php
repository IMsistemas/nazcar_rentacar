<?php

namespace App\Http\Controllers\IndexReservation;

use App\Models\Car\Car;
use App\Models\MarcaAuto\Carbrand;
use App\Models\Place\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('indexReservation');
    }

    public function getPlaces()
    {
        return Place::orderBy('nameplace', 'asc')->get();
    }

    public function getCategories()
    {
        return Carbrand::orderBy('namecarbrand', 'asc')->get();
    }

    public function getCar()
    {
        return Car::join('carmodel', 'car.idcarmodel', '=', 'carmodel.idcarmodel')
            ->join('carbrand', 'carmodel.idcarbrand', '=', 'carbrand.idcarbrand')
            ->join('fuel', 'car.idfuel', '=', 'fuel.idfuel')
            ->join('transmission', 'car.idtransmission', '=', 'transmission.idtransmission')
            ->orderBy('idcar', 'asc')->get();
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
}
