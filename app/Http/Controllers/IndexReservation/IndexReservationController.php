<?php

namespace App\Http\Controllers\IndexReservation;

use App\Models\Car\Car;
use App\Models\Client\Client;
use App\Models\MarcaAuto\Carbrand;
use App\Models\Person\Person;
use App\Models\Place\Place;
use App\Models\Rent\Rent;
use App\Models\Rent\Rent_Place;
use App\Models\Service\Service;
use App\Models\Slider\Slider;
use App\Models\TypeTime\TypeTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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

    public function getCalculate(Request $request)
    {
        $parameter = json_decode($request->get('parameter'));
        $cantday = $parameter->cantday;
        $price = $parameter->price;

        $result = TypeTime::where('amountday', '>=', $cantday)
                                ->orderBy('amountday', 'asc')->get();

        if ($result[0]->typecalculate == '#') {
            $result_calc = $price * $result[0]->constant;
        } else {
            $result_calc = ($price * $result[0]->constant/100) * ($result[0]->amountday)-($price * $result[0]->amountday);
        }

        return abs($result_calc);
    }

    public function getPlaces()
    {
        return Place::orderBy('nameplace', 'asc')->get();
    }

    public function getCategories()
    {
        return Carbrand::orderBy('namecarbrand', 'asc')->get();
    }

    public function getCar($categories)
    {

        $list = Car::join('carmodel', 'car.idcarmodel', '=', 'carmodel.idcarmodel')
            ->join('carbrand', 'carmodel.idcarbrand', '=', 'carbrand.idcarbrand')
            ->join('fuel', 'car.idfuel', '=', 'fuel.idfuel')
            ->join('transmission', 'car.idtransmission', '=', 'transmission.idtransmission')
            ->orderBy('idcar', 'asc');

        if ($categories != 0) {
            $list = $list->where('carbrand.idcarbrand', $categories);
        }

        return $list->get();
    }

    public function getAditionalServices()
    {
        return Service::where('type', '0')->orderBy('service', 'asc')->get();
    }

    public function getOtherServices()
    {
        return Service::where('type', '1')->orderBy('service', 'asc')->get();
    }

    public function getSlider()
    {
        return Slider::where('state', 1)->orderBy('order', 'asc')->get();
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

    public function login(Request $request)
    {
        $user = Person::where( 'emailperson', $request->input('email' ) )->get();

        if ( count( $user ) > 0 ) {

            $client = Client::where('client.idperson', $user[0]->idperson)
                ->join('person', 'person.idperson', '=', 'client.idperson')
                ->get();

            if( Hash::check( $request->input('password'), $client[0]->password  ) ) {

                Session::put('client', $client);

                return response()->json(['success' => true, 'client' => $client[0]]);

            } else {

                return response()->json(['success' => false]);

            }

        } else {

            return response()->json(['success' => false]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $exists = $this->searchClient($request->input('emailperson'));

        $idclient = null;
        $result_register = true;

        if ($exists != false) {

            $client = Client::where('idperson', $exists)->get();

            $idclient = $client[0]->idclient;

        } else {

            $person = new Person();

            $person->nameperson = $request->input('nameperson');
            $person->lastnameperson = $request->input('lastnameperson');
            $person->identifyperson = $request->input('identifyperson');
            $person->emailperson = $request->input('emailperson');
            $person->numphoneperson = $request->input('numphoneperson');

            if ($person->save()) {

                $client = new Client();

                $client->idperson = $person->idperson;
                $client->registerstatus = 0;
                $client->state = 1;

                if ($client->save()) {

                    $idclient = $client->idclient;

                } else {

                    return response()->json(['success' => false]);

                }

            } else {

                return response()->json(['success' => false]);

            }

        }


        if ($request->input('stateRegister') == 1) {
            $result_register = $this->register($idclient, $request->input('registerpassword'));
        }

        if ($result_register != false) {

            $rent = new Rent();

            $rent->idcar = $request->input('idcar');
            $rent->idclient = $idclient;
            $rent->startdatetime = $request->input('startdatetime');
            $rent->enddatetime = $request->input('enddatetime');
            $rent->totalcost = $request->input('totalcost');

            if ($rent->save()){

                $rentplace = new Rent_Place();

                $rentplace->idrent = $rent->idrent;
                $rentplace->idplaceretreat = $request->input('idplaceretreat');
                $rentplace->idplacereturn = $request->input('idplacereturn');

                if ($rentplace->save()) {

                    return response()->json(['success' => true]);

                } else {

                    return response()->json(['success' => false]);

                }

            } else {

                return response()->json(['success' => false]);

            }

        } else {

            return response()->json(['success' => false]);

        }


    }

    public function caja(Request $request)
    {

        $exists = $this->searchClient($request->input('emailperson'));

        $idclient = null;
        $result_register = true;

        if ($exists != false) {

            $client = Client::where('idperson', $exists)->get();

            $idclient = $client[0]->idclient;

        } else {

            $person = new Person();

            $person->nameperson = $request->input('nameperson');
            $person->lastnameperson = $request->input('lastnameperson');
            $person->identifyperson = $request->input('identifyperson');
            $person->emailperson = $request->input('emailperson');
            $person->numphoneperson = $request->input('numphoneperson');

            if ($person->save()) {

                $client = new Client();

                $client->idperson = $person->idperson;
                $client->registerstatus = 0;
                $client->state = 1;

                if ($client->save()) {

                    $idclient = $client->idclient;

                } else {

                    return response()->json(['success' => false]);

                }

            } else {

                return response()->json(['success' => false]);

            }

        }


        if ($request->input('stateRegister') == 1) {
            $result_register = $this->register($idclient, $request->input('registerpassword'));
        }

        if ($result_register != false) {

            $rent = new Rent();

            $rent->idcar = $request->input('idcar');
            $rent->idclient = $idclient;
            $rent->startdatetime = $request->input('startdatetime');
            $rent->enddatetime = $request->input('enddatetime');
            $rent->totalcost = $request->input('totalcost');

            if ($rent->save()){

                $rentplace = new Rent_Place();

                $rentplace->idrent = $rent->idrent;
                $rentplace->idplaceretreat = $request->input('idplaceretreat');
                $rentplace->idplacereturn = $request->input('idplacereturn');

                if ($rentplace->save()) {

                    return response()->json(['success' => true]);

                } else {

                    return response()->json(['success' => false]);

                }

            } else {

                return response()->json(['success' => false]);

            }

        } else {

            return response()->json(['success' => false]);

        }


    }

    private function searchClient($email)
    {
        $person = Person::where('emailperson', $email)->get();

        if (count($person) == 1) {

            return $person[0]->idperson;

        } else {

            return false;

        }
    }

    private function register($idclient, $password)
    {
        $client = Client::find($idclient);

        $client->password = Hash::make($password);
        $client->registerstatus = 1;

        return ($client->save()) ? true : false;
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
