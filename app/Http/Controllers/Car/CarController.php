<?php

namespace App\Http\Controllers\Car;

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
