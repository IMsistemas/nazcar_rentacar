<?php

namespace App\Http\Controllers\Index;

use App\Models\Administrator\Administrator;
use App\Models\Person\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
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

            return view('index');

        }
    }

    public function viewIndex()
    {
        return view('Index.index');
    }

    public function logout()
    {
        Session::flush();

        return response()->json(['success' => true]);
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
        $user = Administrator::where( 'users', $request->input('users' ) )->get();

        if ( count( $user ) > 0 ) {

            if( Hash::check( $request->input('password'), $user[0]->password  ) ) {

                Session::put('users', $user);

                return response()->json(['success' => true]);

            } else {

                return response()->json(['success' => false]);

            }

        } else {

            return response()->json(['success' => false]);

        }
    }

    public function resetPassword(Request $request)
    {
        $admin = Administrator::all();

        $newPassword = $this->generatePassword(8);

        $updateAdmin = Administrator::find($admin[0]->idadministrator);

        $updateAdmin->password = Hash::make($newPassword);

        if ($updateAdmin->save()) {

            $person = Person::find($updateAdmin->idperson);

            $correo = $person->emailperson;

            Mail::send('User.bodyResetPass',['emailnew' => $newPassword] , function($message) use ($correo)
            {
                $message->from('notificacionimnegocios@gmail.com', 'Nazcar');

                $message->to($correo)->subject('Solicitud de Cambio de Password');
            });

            return response()->json(['success' => true]);

        } else {

            return response()->json(['success' => false]);

        }
    }

    private function generatePassword($longitud)
    {

        $codigo = '';

        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        $max = strlen($caracteres) - 1;

        for($i = 0; $i < $longitud; $i++) {

            $codigo .= $caracteres[rand(0, $max)];

        }

        return $codigo;
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
        //
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
