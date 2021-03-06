<?php

namespace App\Http\Controllers\Reports;

use App\Models\Rent\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CountRentxMonthController extends Controller
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

            return view('Reports.countrentxmonth');

        }
    }


    public function getCountRentxMonth($year)
    {
        /*return Rent::selectRaw('MONTH(startdatetime) AS mes, COUNT(MONTH(startdatetime)) AS cantidad')
            ->whereRaw('YEAR(startdatetime) = ' . $year)
            ->groupBy('mes')->get();*/

        return Rent::join('rentcost', 'rentcost.idrent', '=', 'rent.idrent')
                    ->whereRaw('YEAR(startdatetime) = ' . $year)
                    ->selectRaw('MONTH(rent.startdatetime) AS mes, rentcost.subtotal, rentcost.iva, rentcost.total')
                    ->orderBy('mes', 'asc')->get();
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
