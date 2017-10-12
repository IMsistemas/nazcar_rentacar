<?php

namespace App\Http\Controllers\Car;

use App\Models\Car\Car;
use App\Models\Fuel\Fuel;
use App\Models\MarcaAuto\Carbrand;
use App\Models\ModeloAuto\Carmodel;
use App\Models\Motor\Motor;
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

    public function get_list_marca()
    {
        return Carbrand::orderBy("namecarbrand","ASC")->get();
    }

    public function get_list_motor()
    {
        return Motor::orderBy("namemotor","asc")->get();
    }

    public function get_list_fuel()
    {
        return Fuel::orderBy("namefuel","asc")->get();
    }

    public function get_list_transmission()
    {
        return Transmission::orderBy("nametransmission","asc")->get();
    }

    public function get_list_modelo($id)
    {
        return Carmodel::where('idcarbrand', $id)->orderBy('namecarmodel', 'asc')->get();
    }

    public function listCars(Request $request){
        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $car = Car::join('carmodel', 'carmodel.idcarmodel', '=', 'car.idcarmodel')
            ->join('carbrand', 'carbrand.idcarbrand', '=', 'carmodel.idcarbrand');

        if($search != null){
            $car = $car->whereRaw("(carmodel.namecarmodel LIKE '%" . $search . "%' OR carbrand.namecarbrand LIKE '%" . $search ."%' OR car.nameowner LIKE '%" . $search . "%' OR car.carserial LIKE '%" . $search . "%') ");
        }

        if ($state != null) {
            $car = $car->whereRaw('car.state = ' . $state);
        }

        return $car->orderBy('idcar', 'desc')->paginate(10);
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
        //$car->securetype = $request->input('rent_cost');
        //$car->rentcost = $request->input('rent_cost');
        $car->additionalcost = $request->input('aditional_cost');

        $car->state = 1;

        if ($car->save()) {
            return response()->json(['success' => true]);
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
            return "true";
        }else{
            return "false";
        }
    }
}
