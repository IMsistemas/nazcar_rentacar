<?php

namespace App\Http\Controllers\Service;

use App\Models\Service\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Service.index');
    }

    public function getService(Request $request)
    {

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $service = Service::where('state', $state);

        if ($search != null) {
            $service = $service->whereRaw("service.service LIKE '%" . $search . "%' ");
        }

        return $service->orderBy('service', 'asc')->paginate(10);
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
        $service = new Service();

        $service->service = $request->input('service');
        $service->price = $request->input('price');
        $service->type = $request->input('type');
        $service->state = 1;

        if ($service->save()) {

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
        $service = Service::find($id);

        $service->service = $request->input('service');
        $service->price = $request->input('price');
        $service->type = $request->input('type');

        if ($service->save()) {

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function updateState(Request $request, $id)
    {
        $service = Service::find($id);

        $service->state = $request->input('state');

        if ($service->save()) {

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
