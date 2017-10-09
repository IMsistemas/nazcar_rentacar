<?php

namespace App\Http\Controllers\TypeTime;

use App\Models\TypeTime\TypeTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('TypeTime.index');
    }

    public function getTypeTime(Request $request)
    {

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $service = TypeTime::where('state', $state);

        if ($search != null) {
            $service = $service->whereRaw("typetime.nametypetime LIKE '%" . $search . "%' ");
        }

        return $service->orderBy('nametypetime', 'asc')->paginate(10);
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
        $typetime = new TypeTime();

        $typetime->nametypetime = $request->input('nametypetime');
        $typetime->amountday = $request->input('amountday');
        $typetime->typeclient = $request->input('typeclient');
        $typetime->typecalculate = $request->input('typecalculate');
        $typetime->constant = $request->input('constant');

        $typetime->state = 1;

        if ($typetime->save()) {

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
        $typetime = TypeTime::find($id);

        $typetime->nametypetime = $request->input('nametypetime');
        $typetime->amountday = $request->input('amountday');
        $typetime->typeclient = $request->input('typeclient');
        $typetime->typecalculate = $request->input('typecalculate');
        $typetime->constant = $request->input('constant');

        if ($typetime->save()) {

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function updateState(Request $request, $id)
    {
        $typetime = TypeTime::find($id);

        $typetime->state = $request->input('state');

        if ($typetime->save()) {

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
