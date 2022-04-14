<?php

namespace App\Http\Controllers;

use App\Models\ControlPaper;
use App\Models\Damage;
use App\Models\Part;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ControlPaperController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $controlPaper = $request->all(['type', 'kilometers', 'observations', 'signed', 'vehicle_id']);
        $controlPaper['dateTime'] = Carbon::now();
        ControlPaper::create($controlPaper);

        $controlPaperId = ControlPaper::all()->last()->id;

        $data = $request->all([
            'front_left_wing',
            'back_left_wing',
            'front_right_wing',
            'back_right_wing',
            'grille',
            'front_left_headlight',
            'front_right_headlight',
            'driver_seat',
            'passenger_seat',
            'dashboard',
            'left_front_door',
            'right_front_door',
            'left_back_door',
            'right_back_door',
        ]);

        $partId=0;
        foreach($data as $partStatus) {
            $partId++;

            if (!is_null($partStatus)) {
                Damage::create([
                    'control_paper_id' => $controlPaperId,
                    'damage_type_id' => $partStatus,
                    'part_id' => $partId,
                ]);
            }
        }
    }

    public function show($vehicleId)
    {
        $controlPaper = Vehicle::find($vehicleId)->controlPaper;
        $damages = Damage::all()->where('control_paper_id', '=', $controlPaper->id);

        $controlPaperToDisplay = [];

        $controlPaperToDisplay['dateTime'] = $controlPaper->dateTime;
        $controlPaperToDisplay['vehicle'] = Vehicle::find($controlPaper->vehicle_id);

        foreach ($damages as $damage){
            $damageToDisplay = [];
            $damageToDisplay['part'] = $damage->part->name;
            $damageToDisplay['damage_type'] = $damage->damageType->id;
            $controlPaperToDisplay['damages'][] = $damageToDisplay;
        }

        $controlPaperToDisplay['kilometers'] = $controlPaper->kilometers;
        $controlPaperToDisplay['observations'] = $controlPaper->observations;
        $controlPaperToDisplay['signed'] = $controlPaper->signed;

        return $controlPaperToDisplay;
    }

    public function update(Request $request)
    {
        $data = $request->all();

        ControlPaper::find($data['control_paper_id'])->update([
            'kilometers' => $data['kilometers'],
            'observations' => $data['observations'],
            'signed' => $data['signed']
        ]);

        $damages = $request->all([
            'front_left_wing',
            'back_left_wing',
            'front_right_wing',
            'back_right_wing',
            'grille',
            'front_left_headlight',
            'front_right_headlight',
            'driver_seat',
            'passenger_seat',
            'dashboard',
            'left_front_door',
            'right_front_door',
            'left_back_door',
            'right_back_door',
        ]);

        $partId = 1;

        foreach($damages as $damage)
        {
            if(!is_null($damage)){
                Damage::updateOrCreate([
                    'control_paper_id' => $data['control_paper_id'],
                    'part_id' => $partId,
                    'damage_type_id' => $damage
                ]);
            }else{
                Damage::where('control_paper_id', '=', $data['control_paper_id'])->where('part_id', '=', $partId)->delete();
            }
            $partId++;
        }

        //Debugging for API route testing -> to be removed
        $controlPaperToDisplay = ControlPaper::find($data['control_paper_id']);
        $controlPaperToDisplay->damages;
        return $controlPaperToDisplay;

    }

    public function getLastControlPaper($vehicleId)
    {
        $controlPaper = Vehicle::find($vehicleId)->controlPapers->sortBy('dateTime')->last();
        return $controlPaper;
    }
}
