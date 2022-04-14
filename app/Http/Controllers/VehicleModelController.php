<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modelsToParse = VehicleModel::all();
        $models = [];
        foreach ($modelsToParse as $modelToParse){
            $verification = 0;
            foreach($modelToParse->vehicles as $vehicle){
                if ($vehicle->state_id == 2){
                    $verification .= 1;

                }
            }
            //Verifier si les vehicules sont dispo
            if ($verification != 0){
                $model['id'] = $modelToParse->id;
                $model['name'] = $modelToParse->name;
                $model['brand'] = $modelToParse->brand->name;
                $model['logo'] = $modelToParse->brand->logo;
                $model['seats'] = $modelToParse->seats;
                $models[] = $model;
            }

        }


        return $models;
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
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleModel $vehicleModel)
    {

        $model['id'] = $vehicleModel->id;
        $model['name'] = $vehicleModel->name;
        $model['brand'] = $vehicleModel->brand->name;
        $model['logo'] = $vehicleModel->brand->logo;
        $model['seats'] = $vehicleModel->seats;

        return $model;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleModel $vehicleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleModel  $vehicleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        //
    }
}
