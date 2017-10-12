<?php

namespace App\Http\Controllers\Motor;

use App\Models\Motor\Motor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Session::has('users') == false) {

            return view('login');

        } else {

            return view('Motor.index');

        }

    }

    public function getMotor(Request $request)
    {

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $motor = Motor::where('state', $state);

        if ($search != null) {
            $motor = $motor->whereRaw("motor.namemotor LIKE '%" . $search . "%' ");
        }

        return $motor->orderBy('namemotor', 'asc')->paginate(10);
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
        $motor = new Motor();

        $motor->namemotor = $request->input('namemotor');
        $motor->state = 1;

        if ($motor->save()) {

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
        $motor = Motor::find($id);

        $motor->namemotor = $request->input('namemotor');

        if ($motor->save()) {

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function updateState(Request $request, $id)
    {
        $motor = Motor::find($id);

        $motor->state = $request->input('state');

        if ($motor->save()) {

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
