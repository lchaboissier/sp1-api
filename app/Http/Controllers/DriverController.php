<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Driver::all();
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

    public function getDriversByCompany()
    {
        $companyDriver = [];
        $companyDrivers = [];

        foreach (Auth::user()->company->drivers as $driver){
            $companyDriver['id'] = $driver->id;
            $companyDriver['firstName'] = $driver->firstName;
            $companyDriver['lastName'] = $driver->lastName;
            $companyDriver['street'] = $driver->street;
            $companyDriver['postalCode'] = $driver->postalCode;
            $companyDriver['city'] = $driver->city;
            $companyDriver['mail'] = $driver->mail;
            $companyDriver['phoneNumber'] = $driver->phoneNumber;
            $companyDriver['drivingLicense'] = $driver->drivingLicense;
            $companyDrivers[]= $companyDriver;
        }

        return $companyDrivers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $driver = new Driver();
        $driver->firstName = $request->firstName;
        $driver->lastName = $request->lastName;
        $driver->street = $request->street;
        $driver->postalCode = $request->postalCode;
        $driver->city = $request->city;
        $driver->mail = $request->mail;
        $driver->phoneNumber = $request->phoneNumber;
        $driver->drivingLicense = $request->drivingLicense;
        $driver->company_id = Auth::user()->company->id;
        return $driver->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
