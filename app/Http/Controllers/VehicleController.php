<?php

namespace App\Http\Controllers;

use App\Models\CapacityConfiguration;
use App\Models\CekConfiguration;
use App\Models\PriceConfiguration;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle = Vehicle::paginate(10);

        return view('vehicle.index', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'capacity'      => 'required',
            'normal_bill'   => 'required',
            'extra_bill'    => 'required',
            'extra_time'    => 'required' 
        ]);

        if ($validator->fails()) {
            return $request->ajax()
                ? response()->json(['errors'  => $validator->errors()], 400)
                : back()
                    ->withInput()
                    ->withErrors($validator->errors())
                    ->with('error',"Gagal menyimpan data. Cek kembali data inputan Anda.");
        }

        DB::beginTransaction();
        try {

            $vehicleArray = array(
                'name'  => $request->name
            );

            $vehicle    = Vehicle::create($vehicleArray);

            $capacityArray = array(
                'vehicle_id'    => $vehicle->id,
                'user_id'       => Auth::user()->id,
                'capacity'      => $request->capacity,
            );

            $capacity   = CapacityConfiguration::create($capacityArray);

            $priceArray = array(
                'vehicle_id'    => $vehicle->id,
                'user_id'       => Auth::user()->id,
                'normal_bill'  => $request->normal_bill,
                'extra_bill'    => $request->extra_bill,
                'extra_time'    => $request->extra_time
            );

            $price   = PriceConfiguration::create($priceArray);

            $cekArray = array(
                'vehicle_id'    => $vehicle->id,
                'user_id'       => Auth::user()->id,
            );

            $price   = CekConfiguration::create($cekArray);

            DB::commit();
            return redirect()->route('vehicle.index')->with('success','Data Berhasil di Tambah');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->route('admin.employee.index')->with('error', 'Data Gagal di Tanbah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('vehicle.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
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
            'name'      => $request->name,
        );

        $vehicle->update($arrayData);

        return redirect()->route('vehicle.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        PriceConfiguration::destroy($vehicle->id);
        CapacityConfiguration::destroy($vehicle->id);
        CekConfiguration::destroy($vehicle->id);

        return redirect()->route('vehicle.index')->with('error','Data Berhasil di Hapus!');
    }
}