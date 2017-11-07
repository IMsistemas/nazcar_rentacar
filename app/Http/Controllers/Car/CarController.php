<?php

namespace App\Http\Controllers\Car;

use App\Models\Car\Car;
use App\Models\Fleet\Fleet;
use App\Models\Fuel\Fuel;
use App\Models\MarcaAuto\Carbrand;
use App\Models\ModeloAuto\Carmodel;
use App\Models\Motor\Motor;
use App\Models\Place\Place;
use App\Models\Transmission\Transmission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     *
     * Load view
     *
     */
    public function index()
    {

        if (Session::has('users') == false) {

            return view('login');

        } else {

            return view('Car.car_index');

        }

    }

    public function get_list_sedes()
    {
        return Place::where('state', 1)->orderBy('nameplace', 'asc')->get();
    }

    public function get_list_marca()
    {
        return Carbrand::where('state', 1)->orderBy("namecarbrand","ASC")->get();
    }

    public function get_list_motor()
    {
        return Motor::where('state', 1)->orderBy("namemotor","asc")->get();
    }

    public function get_list_fuel()
    {
        return Fuel::where('state', 1)->orderBy("namefuel","asc")->get();
    }

    public function get_list_transmission()
    {
        return Transmission::where('state', 1)->orderBy("nametransmission","asc")->get();
    }

    public function get_list_modelo($id)
    {
        return Carmodel::where('state', 1)->where('idcarbrand', $id)->orderBy('namecarmodel', 'asc')->get();
    }

    public function listCars(Request $request){
        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $car = Car::join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
            ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand')
            ->join('fuel', 'fuel.idfuel', '=', 'car.idfuel')
            ->join('motor', 'motor.idmotor', '=', 'car.idmotor')
            ->join('transmission', 'transmission.idtransmission', '=', 'car.idtransmission')
            ->join('fleet', 'fleet.idcar', '=', 'car.idcar')
            ->join('place', 'place.idplace', '=', 'fleet.idplace');

        if($search != null){
            $car = $car->whereRaw("(carmodel.namecarmodel LIKE '%" . $search . "%' OR carbrand.namecarbrand LIKE '%" . $search ."%' OR car.nameowner LIKE '%" . $search . "%') ");
        }

        if ($state != null) {
            $car = $car->whereRaw('car.state = ' . $state);
        }

        return $car->selectRaw('car.*, fleet.*, place.*, carbrand.namecarbrand, carbrand.idcarbrand, carmodel.namecarmodel, 
                                    carmodel.price, carmodel.guarantee, fuel.namefuel, motor.namemotor, transmission.nametransmission')
                        ->orderBy('car.idcar', 'desc')->paginate(10);
    }
    /**
     *
     *
     * Save Cars
     *
     */
    public function store(Request $request){
        $url_file = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path() . '/uploads/images';
            $name = rand(0, 9999) . '_' . $file->getClientOriginalName();

            if(!$file->move($destinationPath, $name)) {
                return response()->json(['success' => false]);
            } else {
                $url_file = 'uploads/images/' . $name;
            }

        }

        if ($request->input('id') == 0) {

            $car = new Car();
            $car->image = $url_file;

        } else {

            $car = Car::find($request->input('id'));

            if ($url_file != null) {
                $car->image = $url_file;
            }

        }

        $car->idcarmodel = $request->input('car_model');
        $car->idmotor = $request->input('idmotor');
        $car->idfuel = $request->input('idfuel');
        $car->idtransmission = $request->input('idtransmission');
        $car->year = $request->input('year');
        $car->nameowner = $request->input('name_owner');
        $car->amountpassengers = $request->input('amountpassengers');
        $car->amountluggage = $request->input('amountluggage');
        $car->insurancecompany = $request->input('insurance_company');
        $car->securecode = $request->input('secure_code');
        $car->licenseplate = $request->input('licenseplate');
        $car->color = $request->input('color');

        $car->state = 1;

        if ($car->save()) {

            if ($request->input('idfleet') == 0) {

                $fleet = new Fleet();

            } else {

                $fleet = Fleet::find($request->input('idfleet'));

            }

            $fleet->idplace = $request->input('idplace');
            $fleet->idcar = $car->idcar;
            $fleet->fleet = $request->input('fleet');

            if ($fleet->save()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }

        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     *
     * Update Cars
     *
     *
     */
    public function update(Request $request, $id){

    }
    /**
     *
     * Modi
     *
     */
    public function modify_estado($data)
    {
        $data = json_decode($data);
        $car=Car::find($data->id);
        $car->state=$data->state;
        $respuesta=$car->save();
        if($respuesta==1){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
