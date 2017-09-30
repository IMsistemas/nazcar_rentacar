<?php

namespace App\Http\Controllers\Car;

use App\Models\Car\Car;
use App\Models\MarcaAuto\Carbrand;
use App\Models\ModeloAuto\Carmodel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     *
     * Load view
     *
     */
    public function index()
    {
        return view('Car.car_index');
    }

    public function get_list_marca()
    {

        return Carbrand::orderBy("namecarbrand","ASC")->get();
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

    }

    /**
     *
     * Update Cars
     *
     *
     */
    public function update(Request $request, $id){

        $url_file = null;

        if ($request->hasFile('urlphoto')) {
            $image = $request->file('urlphoto');
            $destinationPath = public_path() . '/uploads/school';
            $name = rand(0, 9999) . '_' . $image->getClientOriginalName();
            if (!$image->move($destinationPath, $name)) {
                return response()->json(['success' => false]);
            } else {
                $url_file = '/uploads/school/' . $name;
            }
        }

        $school = new School();

        $school->ruc = $request->input('ruc');
        $school->businessname = $request->input('businessname');
        $school->tradename = $request->input('tradename');
        $school->address = $request->input('address');
        $school->phone = $request->input('phone');
        $school->email = $request->input('email');
        $school->urlphoto = $request->input('urlphoto');

        if ($request->input('specialtaxpayer') == '') {
            $school->specialtaxpayer = null;
        } else {
            $school->specialtaxpayer = $request->input('specialtaxpayer');
        }

        if ($request->input('forcedaccounting') === true) {
            $school->forcedaccounting = 1;
        } else {
            $school->forcedaccounting = 0;
        }

        if ($url_file != null) {
            $school->urlphoto = $url_file;
        }

        return ($school->save()) ? response()->json(['success' => true]) : response()->json(['success' => false]);

    }
    /**
     *
     * Modi
     *
     */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $modelo=Carmodel::find($datos->idcarmodel);
        $modelo->state=$datos->state;
        $respuesta=$modelo->save();
        if($respuesta==1){
            return "true";
        }else{
            return "false";
        }
    }
}
