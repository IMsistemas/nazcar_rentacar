<?php

namespace App\Http\Controllers\FormaPago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\FormaPago\Paidform;

class FormaPagoController extends Controller
{
    /**
     *
     *
     * Cargar vista
     *
     */
    public function index()
    {
    	return view('FormaPago.Pago');
    }
    /**
     *
     *
     * Guardar Pago
     *
     */
    public function store(Request $request){
        $data = $request->all();
        $respuesta=Paidform::create($data);
        if($respuesta->idpaidform>0){
            return "true";
        }else{
            return "false";
        }
    }
    /**
     *
     *
     * Lista de forma de pagos
     *
     */
    public function get_list_pago(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" namepaidform LIKE '%".$filter->buscar."%' ";
        }
        $data=Paidform::whereRaw(" state='".$filter->estado."' ".$sql)
                        ->orderBy("namepaidform","ASC");
        return $data->paginate(10);
    }
    /**
     *
     * Modifcar marca
     *
     *
     */
    public function update(Request $request, $id){
        $data = $request->all();
        $respuesta=Paidform::whereRaw("idpaidform=".$id)
                            ->update($data);
        if($respuesta==1){
            return "true";
        }else{
            return "false";
        }
    }
    /**
     *
     *
     * Modificar estado marca
     *
     */
    public function modify_estado($texto)
    {
        $datos = json_decode($texto);
        $frompago=Paidform::find($datos->idpaidform);
        $frompago->state=$datos->state;
        $respuesta=$frompago->save();
        if($respuesta==1){
            return "true";
        }else{
            return "false";
        }   
    }
}
