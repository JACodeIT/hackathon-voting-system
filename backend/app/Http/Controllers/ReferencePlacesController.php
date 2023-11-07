<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Region;
use App\Models\Province;
use App\Models\CityMun;
use App\Models\Barangay;

class ReferencePlacesController extends Controller
{
    /**
     * Display a listing of the all the Regions.
     */
    public function showRegions()
    {
        return Region::select('id', 'regDesc')->get();
    }

    /**
     * Display a listing of the all the Provinces of the specified Region.
     *
     * @param (string Id) // Region ID
     */
    public function showProvinces(string $id)
    {
        return Province::select('id', 'provDesc')->where('regionID', $id)->get();
    }

    /**
     * Display a listing of the all the Cities and Municipalities of specified Province.
     *
     * @param (string Id) // Province ID
     */
    public function showCityMuns(string $id)
    {
        return CityMun::select('id', 'citymunDesc')->where('provinceID', $id)->get();
    }


    /**
     * Display a listing of the all the Barangays of the specified City or Municipality.
     *
     * @param (string Id) // CityMun ID
     */
    public function showBarangays(string $id)
    {
        return Barangay::select('id', 'brgyDesc')->where('citymunID', $id)->get();
    }
}
