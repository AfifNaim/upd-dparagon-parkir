<?php

namespace App\Http\Controllers;

use App\Exports\ParkingExport;
use App\Models\CapacityConfiguration;
use App\Models\CekConfiguration;
use App\Models\Parking;
use App\Models\PriceConfiguration;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parking = Parking::orderBy('date', 'ASC')->paginate(20);

        return view('parking/index', compact('parking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicle = Vehicle::all();

        return view('parking.create', compact('vehicle'));
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
            'vehicle_id'        => 'required',
            'vehicle_number'    => 'required'
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
            'vehicle_id'        => $request->vehicle_id,
            'vehicle_number'    => $request->vehicle_number,
            'user_id'           => Auth::user()->id,
            'date'              => date('Y-m-d'),
            'time_in'           => date('Y-m-d H:i:s')
        );

        $cek        = CekConfiguration::where('vehicle_id', $request->vehicle_id)->first();
        $capacity   = CapacityConfiguration::where('vehicle_id', $request->vehicle_id)->first();

        if ($cek->capacity < $capacity->capacity){
            if (Parking::create($arrayData)) {
                $cek->capacity = $cek->capacity + 1;
                $cek->save();
            
                return redirect()->route('parking.index')->with('success','Data Berhasil di Tambah');
            }
        } else {
            return redirect()->route('parking.index')->with('error','Lahan Parkir Penuh');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking)
    {
        return view('parking.show', compact('parking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function edit(Parking $parking)
    {
        $vehicle = Vehicle::all();

        return view('parking.edit', compact('parking', 'vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id'        => 'required',
            'vehicle_number'    => 'required'
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
            'vehicle_id'        => $request->vehicle_id,
            'vehicle_number'    => $request->vehicle_number,
        );

        $parking->update($arrayData);

        return redirect()->route('parking.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {
        $parking->delete();

        return redirect()->route('parking.index')->with('error','Data Berhasil di Hapus');
    }

    public function out(Request $request, Parking $parking)
    {
        $time       = date('Y-m-d H:i:s');
        $time_in    = strtotime($parking->time_in);
        $time_out   = strtotime($time);
        $diff       = ($time_out - $time_in) / (60 * 60);
        $price      = PriceConfiguration::where('vehicle_id', $parking->vehicle_id)->first();

        if ($diff < $price->extra_time) {
            $bill = $price->normal_bill;
        } else {
            $bill = $price->extra_bill;
        }

        $arrayData = array(
            'user_id'   => Auth::user()->id,
            'time_out'  => $time,
            'bill'      => $bill
        );
        
        if ($parking->update($arrayData)) {
            $cek = CekConfiguration::where('vehicle_id', $parking->vehicle_id)->first();
            $cek->capacity = $cek->capacity - 1;
            $cek->save();
        }

        return redirect()->route('parking.index')->with('success','Berhasil keluar!');
    }

    public function report()
    {
        $start  = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
        $end    = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');

        if (request()->date != '') {
            $date   = explode(' - ' ,request()->date);
            $start  = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
            $end    = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
        }

        $parking = Parking::whereBetween('date', [$start, $end])->get();

        return view('parking.report', compact('parking'));
    }

    public function excel($daterange)
    {
        $date = explode('+', $daterange);

        $start = Carbon::parse($date[0])->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::parse($date[1])->format('Y-m-d') . ' 23:59:59';
    
        $parking = Parking::whereBetween('date', [$start, $end])->get();

        return Excel::download(new ParkingExport($parking), 'Laporan Parkinr - '. time() .'.xls');
    }
}
