<?php

namespace App\Http\Controllers\Gantt;

use App\Models\Rent\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GanttController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::has('users') == false) {

            return view('login');

        } else {

            return view('Gantt.index');

        }
    }

    public function getRent()
    {

        return Rent::join('client', 'client.idclient', '=', 'rent.idclient')
            ->join('person', 'person.idperson', '=', 'client.idperson')
            ->join('car', 'car.idcar', '=', 'rent.idcar')
            ->join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
            ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand')
            ->join('rentcost', 'rentcost.idrent', '=', 'rent.idrent')
            ->join('rent_place', 'rent_place.idrent', '=', 'rent.idrent')
            ->selectRaw('*, rent.state AS staterent, 
                            (SELECT nameplace FROM place WHERE place.idplace = rent_place.idplaceretreat) AS placeretreat,
                            (SELECT nameplace FROM place WHERE place.idplace = rent_place.idplacereturn) AS placereturn')->get();

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
