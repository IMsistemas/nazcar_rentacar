<?php

namespace App\Http\Controllers\Paypal;

use App\Models\Paypal\Paypal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaypalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getDataPaypal()
    {
        return Paypal::get();
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
        $object = new Paypal();

        $object->client_id_sandox = $request->input('client_id_sandox');
        $object->secret_id_sandox = $request->input('secret_id_sandox');
        $object->client_id_live = $request->input('client_id_live');
        $object->secret_id_live = $request->input('secret_id_live');

        $object->mode = 0;

        if ($object->save()) {

            return response()->json(['success' => true]);

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
        $object = Paypal::find($id);

        $object->client_id_sandox = $request->input('client_id_sandox');
        $object->secret_id_sandox = $request->input('secret_id_sandox');
        $object->client_id_live = $request->input('client_id_live');
        $object->secret_id_live = $request->input('secret_id_live');

        $object->mode = 0;

        if ($object->save()) {

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
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
