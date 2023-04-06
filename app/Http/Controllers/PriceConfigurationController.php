<?php

namespace App\Http\Controllers;

use App\Models\PriceConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PriceConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price = PriceConfiguration::paginate(10);

        return view('price.index', compact('price'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceConfiguration  $priceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(PriceConfiguration $priceConfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceConfiguration  $priceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceConfiguration $price)
    {
        return view('price.edit', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceConfiguration  $priceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceConfiguration $price)
    {
        $validator = Validator::make($request->all(), [
            'normal_bill'   => 'required',
            'extra_bill'    => 'required',
            'extra_time'    => 'required',
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        $arrayData = array(
            'user_id'       => Auth::user()->id,
            'normal_bill'   => $request->normal_bill,
            'extra_bill'    => $request->extra_bill,
            'extra_time'    => $request->extra_time
        );

        $price->update($arrayData);

        return redirect()->route('price.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceConfiguration  $priceConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceConfiguration $priceConfiguration)
    {
        //
    }
}
