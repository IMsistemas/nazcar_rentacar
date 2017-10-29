<?php

namespace App\Http\Controllers\Rent;

use App\Models\Car\Car;
use App\Models\Client\Client;
use App\Models\MarcaAuto\Carbrand;
use App\Models\Rent\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RentController extends Controller
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

            return view('Rent.index');

        }

    }

    /**
     * Get list of Clients.
     */

    public function getListClients(){
        return Client::join('person', 'person.idperson', '=', 'client.idperson')
        ->orderBy('idclient', 'asc')->get();
    }

    /**
     * Get list of Car Brands.
     */

    public function getCarBrands(){
        return Carbrand::orderBy("namecarbrand","ASC")->get();
    }

    /**
     * Show the list of Rents.
     */

    public function listRents(Request $request){

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $client = $filter->idclient;
        $carbran = $filter->idcarbran;
        $state = $filter->state;

        $rent = Rent::join('client', 'client.idclient', '=', 'rent.idclient')
            ->join('person', 'person.idperson', '=', 'client.idperson')
            ->join('car', 'car.idcar', '=', 'rent.idcar')
            ->join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
            ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand')
            ->join('rentcost', 'rentcost.idrent', '=', 'rent.idrent')
            ->join('rent_place', 'rent_place.idrent', '=', 'rent.idrent')
            ->selectRaw('*, rent.state AS staterent, 
                            (SELECT nameplace FROM place WHERE place.idplace = rent_place.idplaceretreat) AS placeretreat,
                            (SELECT nameplace FROM place WHERE place.idplace = rent_place.idplacereturn) AS placereturn');

        if($search != null){

            $rent = $rent->whereRaw("(person.nameperson LIKE '%" . $search . "%' OR person.lastnameperson LIKE '%" . $search ."%' OR carmodel.namecarmodel LIKE '%" . $search . "%' OR carbrand.namecarbrand LIKE '%". $search . "%' ) ");

        }

        if ($client != null && $client != '') {

            $rent = $rent->whereRaw('rent.idclient = ' . $client);

        }

        if ($carbran != null && $carbran != '') {

            $rent = $rent->whereRaw('carbrand.idcarbrand = ' . $carbran);

        }

        if ($state != null) {

            if ($state == 1) {
                $rent = $rent->whereRaw('rent.state = ' . $state . ' OR ISNULL(rent.state)');
            } else {
                $rent = $rent->whereRaw('rent.state = ' . $state);
            }

        }

        return $rent->orderBy('rent.idrent', 'desc')->paginate(10);
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

        $object = Rent::find($id);

        $object->state = $request->input('state');


        if ($object->save()) {

            return response()->json(['success' => true]);

        } else return response()->json(['success' => false]);

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
