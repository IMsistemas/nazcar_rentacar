<?php

namespace App\Http\Controllers\Fuel;

use App\Models\Fuel\Fuel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Fuel.index');
    }

    public function getFuel(Request $request)
    {

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $fuel = Fuel::where('state', $state);

        if ($search != null) {
            $fuel = $fuel->whereRaw("fuel.namefuel LIKE '%" . $search . "%' ");
        }

        return $fuel->orderBy('namefuel', 'asc')->paginate(10);
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
        $fuel = new Fuel();

        $fuel->namefuel = $request->input('namefuel');
        $fuel->state = 1;

        if ($fuel->save()) {

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
        $fuel = Fuel::find($id);

        $fuel->namefuel = $request->input('namefuel');

        if ($fuel->save()) {

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function updateState(Request $request, $id)
    {
        $fuel = Fuel::find($id);

        $fuel->state = $request->input('state');

        if ($fuel->save()) {

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
