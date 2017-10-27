<?php

namespace App\Http\Controllers\MarcaAuto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\MarcaAuto\Carbrand;
use Illuminate\Support\Facades\Session;


class MarcaController extends Controller
{
    /**
     *
     *
     * Cargar vista
     *
     */
    public function index()
    {

        if (Session::has('users') == false) {

            return view('login');

        } else {

            return view('MarcaAuto.Marca');

        }

    }
    /**
     *
     *
     * Lista de marcas
     *
     */
    public function get_list_marca(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $filter->estado;
        $sql="";
        if($filter->buscar!=""){
            $sql=" namecarbrand LIKE '%".$filter->buscar."%' ";
        }
        $data=Carbrand::whereRaw(" state='".$filter->estado."' ".$sql)
                        ->orderBy("namecarbrand","ASC");
        return $data->paginate(10);
    }
    /**
     *
     *
     * Guardar Marca
     *
     */
    public function store(Request $request){
        $data = $request->all();
        $respuesta=Carbrand::create($data);
        if($respuesta->idcarbrand>0){
            return "true";
        }else{
            return "false";
        }
    }
    /**
     *
     * Modifcar marca
     *
     *
     */
    public function update(Request $request, $id){
        /*$data = $request->all();
        /*$respuesta=Carbrand::whereRaw("idcarbrand=".$id)
                            ->update($data);

        if($respuesta==1){
            return "true";
        }else{
            return "false";
        }*/

        $object=Carbrand::find($id);

        $object->namecarbrand = $request->input('namecarbrand');

        if ($object->save()) {
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
        $marca=Carbrand::find($datos->idcarbrand);
        $marca->state=$datos->state;
        $respuesta=$marca->save();
        if($respuesta==1){
            return "true";
        }else{
            return "false";
        }   
    }
}
