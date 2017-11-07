<?php

namespace App\Http\Controllers\IndexReservation;

use App\Models\Car\Car;
use App\Models\Client\Client;
use App\Models\Company\Company;
use App\Models\CountryPhone\CountryPhone;
use App\Models\MarcaAuto\Carbrand;
use App\Models\Person\Person;
use App\Models\Place\Place;
use App\Models\Rent\Rent;
use App\Models\Rent\Rent_Place;
use App\Models\Rent\RentCost;
use App\Models\Service\Service;
use App\Models\Slider\Slider;
use App\Models\TypeTime\TypeTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

            //$result_calc = $price * $result[0]->constant;

            $result_calc = $price * $cantday;

        } else {

            //$result_calc = ($price * $result[0]->constant/100) * ($result[0]->amountday)-($price * $result[0]->amountday);

            $result_calc = ($price * $cantday) - ((($price * $cantday) * $result[0]->constant) / 100);

        }

        return abs($result_calc);
    }

    public function getPlaces()
    {
        return Place::where('state', '1')->orderBy('nameplace', 'asc')->get();
    }

    public function getCategories()
    {
        return Carbrand::where('state', '1')->orderBy('namecarbrand', 'asc')->get();
    }

    public function getCar(Request $request)
    {

        $filter = json_decode($request->get('filter'));

        $list = Car::join('carmodel', 'car.idcarmodel', '=', 'carmodel.idcarmodel')
            ->join('carbrand', 'carmodel.idcarbrand', '=', 'carbrand.idcarbrand')
            ->join('fuel', 'car.idfuel', '=', 'fuel.idfuel')
            ->join('motor', 'car.idmotor', '=', 'motor.idmotor')
            ->join('transmission', 'car.idtransmission', '=', 'transmission.idtransmission')
            ->whereRaw("idcar NOT IN (SELECT idcar FROM rent WHERE '" . $filter->date_ini . "'  BETWEEN rent.startdatetime AND rent.enddatetime) ")
            ->where('car.state', '1')
            ->orderBy('idcar', 'asc');

        if ($filter->categories != 0) {

            $list = $list->where('carbrand.idcarbrand', $filter->categories);

        }

        return $list->get();
    }

    public function getAditionalServices()
    {
        return Service::where('type', '0')
                ->where('state', '1')->orderBy('service', 'asc')->get();
    }

    public function getOtherServices()
    {
        return Service::where('type', '1')
                ->where('state', '1')->orderBy('service', 'asc')->get();
    }

    public function getSlider()
    {
        return Slider::where('state', 1)->orderBy('order', 'asc')->get();
    }

    public function getCompany()
    {
        return Company::get();
    }

    public function getCountryPhone()
    {
        return CountryPhone::orderBy('namecountry0', 'asc')->get();
    }

    public function getResultPagoPaypal()
    {
        if (Session::has('pagoPaypal') == true) {

            return 'true';

        } else {

            return 'false';

        }
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
            $person->typeperson = 1;

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
            $rent->flightnumber = $request->input('flightnumber');

            $numrent = $this->searchNumRent();

            $rent->numrent = $numrent;

            Session::put('numrent', $numrent);

            $rent->state = 1;

            if ($rent->save()){

                $rentcost = new RentCost();

                $rentcost->idrent = $rent->idrent;
                $rentcost->subtotal = $request->input('subtotal');
                $rentcost->iva = $request->input('iva');
                $rentcost->total = $request->input('totalcost');

                if ($rentcost->save()) {

                    $rentplace = new Rent_Place();

                    $rentplace->idrent = $rent->idrent;
                    $rentplace->idplaceretreat = $request->input('idplaceretreat');
                    $rentplace->idplacereturn = $request->input('idplacereturn');

                    if ($rentplace->save()) {

                        Session::put('dataRentPaypal', $request->input('dataRent'));

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
            $rent->flightnumber = $request->input('flightnumber');

            $numrent = $this->searchNumRent();

            $rent->numrent = $numrent;

            Session::put('numrent', $numrent);

            $rent->state = 1;

            if ($rent->save()){

                $rentcost = new RentCost();

                $rentcost->idrent = $rent->idrent;
                $rentcost->subtotal = $request->input('subtotal');
                $rentcost->iva = $request->input('iva');
                $rentcost->total = $request->input('totalcost');

                if ($rentcost->save()) {

                    $rentplace = new Rent_Place();

                    $rentplace->idrent = $rent->idrent;
                    $rentplace->idplaceretreat = $request->input('idplaceretreat');
                    $rentplace->idplacereturn = $request->input('idplacereturn');

                    if ($rentplace->save()) {

                        Session::put('dataRentCaja', $request->input('dataRent'));

                        $this->sendEmailCaja();

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

        } else {

            return response()->json(['success' => false]);

        }


    }

    private function searchNumRent()
    {
        $num = Rent::orderBy('numrent')->get();

        if (count($num) == 0) {

            return str_pad('1', 7, "0", STR_PAD_LEFT);

        } else {

            $numero = $num[count($num) - 1]->numrent;

            settype($numero, 'integer');

            $numero += 1;

            return str_pad($numero, 7, "0", STR_PAD_LEFT);

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


    public function sendEmail()
    {

        if (Session::get('pagoPaypal') == true) {

            $params = json_decode(Session::get('dataRentPaypal'));

            $image_url = Car::find($params->idcar);
            $image_url = $image_url->image;

            $aux_empresa = Company::all();

            $numrent = Session::get('numrent');

            $today = date("Y-m-d H:i:s");

            if ($params->emailperson != '' && $params->emailperson != null) {

                $correo_cliente = $params->emailperson;

                Mail::send('Vouchers.vouchercash2',['params' => $params, 'today' => $today, 'image_url' => $image_url, 'aux_empresa' => $aux_empresa, 'numrent' => $numrent] , function($message) use ($correo_cliente)
                {
                    $message->from('notificacionimnegocios@gmail.com', 'Nazcar');

                    $message->to($correo_cliente)
                        /*$message->bcc('christian.imnegocios@gmail.com');
                        $message->bcc('kevin.imnegocios@gmail.com');
                        $message->bcc('raidelbg84@gmail.com');
                        $message->bcc('luis.imnegocios@gmail.com')*/->subject('Comprobante de Renta');
                });

                Session::forget('pagoPaypal');
            }

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }

    }

    private function sendEmailCaja()
    {

        $params = json_decode(Session::get('dataRentCaja'));

        $image_url = Car::find($params->idcar);
        $image_url = $image_url->image;

        $aux_empresa = Company::all();

        $numrent = Session::get('numrent');

        $today = date("Y-m-d H:i:s");

        if ($params->emailperson != '' && $params->emailperson != null) {

            $correo_cliente = $params->emailperson;

            Mail::send('Vouchers.vouchercash2',['params' => $params, 'today' => $today, 'image_url' => $image_url, 'aux_empresa' => $aux_empresa, 'numrent' => $numrent] , function($message) use ($correo_cliente)
            {
                $message->from('notificacionimnegocios@gmail.com', 'Nazcar');

                $message->to($correo_cliente)
                    /*$message->bcc('christian.imnegocios@gmail.com');
                    $message->bcc('kevin.imnegocios@gmail.com');
                    $message->bcc('raidelbg84@gmail.com');
                    $message->bcc('luis.imnegocios@gmail.com')*/->subject('Comprobante de Renta');
            });

            //Session::forget('dataRentCaja');
        }

        return response()->json(['success' => true]);

    }

    private function getImageCar($id)
    {
        return Car::find($id);
    }

    public function printComprobante($params)
    {
        ini_set('max_execution_time', 300);

        $aux_empresa = Company::all();

        $params = json_decode($params);

        $image_url = Car::find($params->idcar);
        $image_url = $image_url->image;

        $numrent = Session::get('numrent');

        $today = date("Y-m-d H:i:s");

        $view =  \View::make('Vouchers.vouchercash2', compact('today', 'params', 'aux_empresa', 'image_url', 'numrent'))->render();

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadHTML($view);

        return $pdf->stream('comprob_' . $today);
    }

}
