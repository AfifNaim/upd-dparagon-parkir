<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class ParkingExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($parking)
    {
        $this->parking = $parking;
    }

    public function view(): View
    {
        return view('parking.excel', ['parking' => $this->parking]);
    }
}
