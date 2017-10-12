<?php

namespace App\Http\Controllers\User;

use App\Models\Administrator\Administrator;
use App\Models\Person\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.index');
    }

    public function getUser(Request $request)
    {

        $filter = json_decode($request->get('filter'));
        $search = $filter->search;
        $state = $filter->state;

        $transmission = Administrator::where('state', $state);

        if ($search != null) {
            $transmission = $transmission->whereRaw("person.nameperson LIKE '%" . $search . "%' ");
        }

        return $transmission->join('person', 'person.idperson', '=', 'administrator.idperson')
            ->orderBy('person.nameperson', 'asc')->paginate(10);
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
        $person = new Person();

        $person->nameperson = $request->input('nameperson');
        $person->lastnameperson = $request->input('lastnameperson');
        $person->identifyperson = $request->input('identifyperson');
        $person->emailperson = $request->input('emailperson');
        $person->numphoneperson = $request->input('numphoneperson');

        if ($person->save()) {

            $admin = new Administrator();

            $admin->users = $request->input('users');
            $admin->password = Hash::make($request->input('password'));
            $admin->idperson = $person->idperson;
            $admin->state = 1;

            if ($admin->save()) {

                return response()->json(['success' => true]);

            } else {

                return response()->json(['success' => false]);

            }

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
        $admin = Administrator::find($id);

        $admin->users = $request->input('users');

        if($request->input('password')!== null){
            $admin->password = Hash::make($request->input('password'));
        }

        if ($admin->save()) {

            $person = Person::find($admin->idperson);

            $person->nameperson = $request->input('nameperson');
            $person->lastnameperson = $request->input('lastnameperson');
            $person->identifyperson = $request->input('identifyperson');
            $person->emailperson = $request->input('emailperson');
            $person->numphoneperson = $request->input('numphoneperson');


            if ($person->save()) {

                return response()->json(['success' => true]);

            } else {

                return response()->json(['success' => false]);

            }

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function updateState(Request $request, $id)
    {
        $admin = Administrator::find($id);

        $admin->state = $request->input('state');

        if ($admin->save()) {

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
