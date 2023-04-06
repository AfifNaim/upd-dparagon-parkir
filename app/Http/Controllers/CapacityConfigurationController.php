<?php

namespace App\Http\Controllers;

use App\Models\CapacityConfiguration;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class CapacityConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $capacity = CapacityConfiguration::paginate(10);

        return view('capacity.index', compact('capacity'));
    }

    /**
     * Show the form for creating a  new resource.
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
     * @param  \App\Models\CapacityConfiguration  $capacityConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(CapacityConfiguration $capacity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CapacityConfiguration  $capacityConfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(CapacityConfiguration $capacity)
    {
        return view('capacity.edit', compact('capacity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CapacityConfiguration  $capacityConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CapacityConfiguration $capacity)
    {
        $validator = Validator::make($request->all(), [
            'capacity'      => 'required'
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
            'capacity'  => $request->capacity,
            'user_id'   => Auth::user()->id
        );

        $capacity->update($arrayData);

        return redirect()->route('capacity.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CapacityConfiguration  $capacityConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(CapacityConfiguration $capacity)
    {
        //
    }
}
