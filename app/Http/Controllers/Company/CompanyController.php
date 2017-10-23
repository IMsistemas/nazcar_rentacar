<?php

namespace App\Http\Controllers\Company;

use App\Models\Company\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
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

            return view('Company.index');

        }
    }

    public function getDataCompany()
    {
        return Company::get();
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

        $url_file = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $destinationPath = public_path() . '/uploads/images';
            $name = rand(0, 9999) . '_' . $file->getClientOriginalName();

            if(!$file->move($destinationPath, $name)) {
                return response()->json(['success' => false]);
            } else {
                $url_file = 'uploads/images/' . $name;
            }

        }

        if ($request->input('idcompany') == 0) {

            $object = new Company();
            $object->logocompany = $url_file;

        } else {

            $object = Company::find($request->input('idcompany'));

            if ($url_file != null) {
                $object->logocompany = $url_file;
            }

        }

        $object->namecompany = $request->input('namecompany');
        $object->ruccompany = $request->input('ruccompany');
        $object->emailcompany = $request->input('emailcompany');
        $object->contributoridcompany = $request->input('contributoridcompany');
        $object->addresscompany = $request->input('addresscompany');

        if ($object->save()) {

            return response()->json(['success' => true, 'idcompany' => $object->idcompany]);

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
        $object = Company::find($id);

        $object->namecompany = $request->input('namecompany');
        $object->ruccompany = $request->input('ruccompany');
        $object->contributoridcompany = $request->input('contributoridcompany');
        $object->addresscompany = $request->input('addresscompany');

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
