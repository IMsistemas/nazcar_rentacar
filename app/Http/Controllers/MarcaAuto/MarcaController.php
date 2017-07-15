<?php

namespace App\Http\Controllers\MarcaAuto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    	return view('MarcaAuto.Marca');
    }
}
