<?php

namespace App\Http\Controllers\Rent;

use App\Models\Rent\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Rent.index');
    }

    /**
     * Show the list of Rents.
     */

    public function listRents(Request $request){
        /*$filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $client = $filter->idclient;
        $car = $filter->idcar;
        $expired = $filter->expired;
        $startdate = $filter->startdate;
        $enddate = $filter->enddate;
        $billingfilter  = $filter->billingfilter;*/

        $rent = Rent::join('client', 'client.idclient', '=', 'rent.idclient')
            ->join('person', 'person.idperson', '=', 'client.idperson')
            ->join('car', 'car.idcar', '=', 'rent.idcar')
            ->join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
            ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand');

        /*if($search != null){
            $key = $key->whereRaw("(client.businessname LIKE '%" . $search . "%' OR client.tradename LIKE '%" . $search ."%' OR client.ruc LIKE '%" . $search . "%' OR key.keyname LIKE '%". $search . "%' ) ");
        }

        if ($client != null) {
            $key = $key->whereRaw('rent.idclient = ' . $client);
        }

        if ($system != null) {
            $key = $key->whereRaw('rent.idcar = ' . $car);
        }

        if ($expired != null) {
            $temp = " (SELECT DATEDIFF(key.enddate, '"  . date('Y-m-d') . "') ";

            if  ($expired == 'A') {
                $temp .= '> 60)';
            } else if ($expired == 'B')  {
                $temp .= "<= 60) AND (SELECT DATEDIFF(key.enddate, '"  . date('Y-m-d') . "') > 30)";
            } else if ($expired == 'C')  {
                $temp .= '<= 30)';
            }

            $rent = $rent->whereRaw($temp);
        }

        if ($billingfilter != null) {
            $key = $key->whereRaw("key.electronicbilling =  '".$billingfilter."'");
        }

        if ($startdate != null) {
            $key = $key->whereRaw("key.startdate =  '".$startdate."'");
        }

        if ($enddate != null) {
            $key = $key->whereRaw("key.enddate = ' ". $enddate."'");
        }*/

        return $rent->orderBy('idrent', 'desc')->paginate(10);
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
