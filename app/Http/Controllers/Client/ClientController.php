<?php

namespace App\Http\Controllers\Client;

use App\Models\Client\Client;
use App\Models\Country\Country;
use App\Models\FormaPago\Paidform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('Client.index');
    }

    /**
     * Get list of Clients.
     */

    public function getListCountry(){
        return Country::orderBy('idcountry', 'asc')->get();
    }

    /**
     * Get list of Car Brands.
     */

    public function getPaidForms(){
        return Paidform::orderBy('idpaidform', 'asc')->get();
    }

    /**
     * Show the list of Rents.
     */

    public function listClients(Request $request){
        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $client = Client::join('person', 'person.idperson', '=', 'client.idperson')
            ->join('country', 'country.idcountry', '=', 'client.idcountry')
            ->join('paidform', 'paidform.idpaidform', '=', 'client.idpaidform');

        if($search != null){
            $client = $client->whereRaw("(person.nameperson LIKE '%" . $search . "%' OR person.lastnameperson LIKE '%" . $search ."%' OR person.identifyperson LIKE '%" . $search . "%') ");
        }

        if ($state != null) {
            $client = $client->whereRaw('client.state = ' . $state);
        }

        return $client->orderBy('idclient', 'desc')->paginate(10);
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
