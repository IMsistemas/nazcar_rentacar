<?php

namespace App\Http\Controllers\Slider;

use App\Models\Slider\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SliderController extends Controller
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

            return view('Slider.index');

        }
    }

    public function getDataSlider(Request $request)
    {
        $filter = json_decode($request->get('filter'));
        $state = $filter->state;

        $fuel = Slider::where('state', $state);

        return $fuel->orderBy('order', 'asc')->paginate(10);
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
            $destinationPath = public_path() . '/uploads/imageslider';
            $name = rand(0, 9999) . '_' . $file->getClientOriginalName();

            if(!$file->move($destinationPath, $name)) {

                return response()->json(['success' => false]);

            } else {

                $url_file = 'uploads/imageslider/' . $name;

            }

        }

        if ($request->input('idslider') == 0) {

            $slider = new Slider();
            $slider->image_url = $url_file;

        } else {

            $slider = Slider::find($request->input('idslider'));

            if ($url_file != null) {

                $slider->image_url = $url_file;

            }

        }

        $slider->order = $request->input('order');
        $slider->language = $request->input('language');
        $slider->state = 1;

        if ($slider->save()) {

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
        //
    }

    public function updateState(Request $request, $id)
    {
        $slider = Slider::find($id);

        $slider->state = $request->input('state');

        if ($slider->save()) {

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
