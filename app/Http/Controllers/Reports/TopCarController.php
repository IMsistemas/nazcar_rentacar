<?php

namespace App\Http\Controllers\Reports;

use App\Models\Rent\Rent;
use App\Models\Rent\Rent_Place;
use App\Models\Rent\RentCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TopCarController extends Controller
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

            return view('Reports.topcar');

        }
    }

    public function getTopCar()
    {
        $rent = Rent::selectRaw( 'rent.idrent, rent.idcar, COUNT(rent.idcar) AS cantidad, carmodel.namecarmodel, carbrand.namecarbrand')
                ->join('car', 'car.idcar', '=', 'rent.idcar')
                ->join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
                ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand')
                ->groupBy('rent.idcar')->orderBy('cantidad', 'desc')
                ->limit(5)->get();

        $rentcost = [];

        foreach ( $rent as $item ) {


            $object = RentCost::where('idrent', $item->idrent)
                ->selectRaw('SUM(rentcost.subtotal) AS subtotal, SUM(rentcost.iva) AS iva, SUM(rentcost.total) AS total')->get();

            $rentcost[] = $object[0];

        }

        return [$rent, $rentcost];

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
