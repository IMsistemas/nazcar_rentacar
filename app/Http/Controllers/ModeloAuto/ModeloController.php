<?php

namespace App\Http\Controllers\ModeloAuto;

use App\Models\MarcaAuto\Carbrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\ModeloAuto\Carmodel;
class ModeloController extends Controller
{
    /**
     *
     *
     * Cargar vista
     *
     */
    public function index()
    {
    	return view('ModeloAuto.Modelo');
    }
    /**
     *
     *
     * Guardar Modelo 
     *
     */
    public function store(Request $request){
        $data = $request->all();
        $respuesta=Carmodel::create($data);
        if($respuesta->idcarmodel>0){
            return "true";
        }else{
            return "false";
        }
    }
    /**
     *
     *
     * Lista de modelos
     *
     */
    public function get_list_modelo(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" namecarmodel LIKE '%".$filter->buscar."%' ";
        }
        $data=Carmodel::whereRaw(" state='".$filter->estado."' ".$sql)
                        ->orderBy("namecarmodel","ASC");
        return $data->paginate(10);
    }


    public function listMarcas()
    {
        return Carbrand::where('state', 1)->orderBy('namecarbrand', 'asc')->get();
    }

    /**
     *
     * Modifcar modelo
     *
     *
     */
    public function update(Request $request, $id){
        $data = $request->all();
        $respuesta=Carmodel::whereRaw("idcarmodel=".$id)
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
     * Modificar estado modelo
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
