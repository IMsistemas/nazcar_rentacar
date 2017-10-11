<?php

namespace App\Http\Controllers\IndexReservation;

use App\Models\Car\Car;
use App\Models\MarcaAuto\Carbrand;
use App\Models\Person\Person;
use App\Models\Place\Place;
use App\Models\Rent\Rent;
use App\Models\Service\Service;
use App\Models\TypeTime\TypeTime;
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

    public function getCar()
    {
        return Car::join('carmodel', 'car.idcarmodel', '=', 'carmodel.idcarmodel')
            ->join('carbrand', 'carmodel.idcarbrand', '=', 'carbrand.idcarbrand')
            ->join('fuel', 'car.idfuel', '=', 'fuel.idfuel')
            ->join('transmission', 'car.idtransmission', '=', 'transmission.idtransmission')
            ->orderBy('idcar', 'asc')->get();
    }

    public function getAditionalServices()
    {
        return Service::where('type', '0')->orderBy('service', 'asc')->get();
    }

    public function getOtherServices()
    {
        return Service::where('type', '1')->orderBy('service', 'asc')->get();
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
        $person = new Person();

        $person->nameperson = $request->input('nameperson');
        $person->lastnameperson = $request->input('lastnameperson');
        $person->identifyperson = $request->input('identifyperson');
        $person->emailperson = $request->input('emailperson');
        $person->numphoneperson = $request->input('numphoneperson');

        if ($person->save()) {

            $rent = new Rent();

            $rent->idcar = $request->input('idcar');
            $rent->startdatetime = $request->input('startdatetime');
            $rent->enddatetime = $request->input('enddatetime');
            $rent->totalcost = $request->input('totalcost');

            if ($rent->save()){
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }

        } else {

            return response()->json(['success' => false]);

        }
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
