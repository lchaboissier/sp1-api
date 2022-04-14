<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Http\Controllers\AgencyController;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\TripType;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Returns every active booking for an agency
    public function activeAgencyBookings($agency_id)
    {
        $allAgencyVehicles = Agency::find($agency_id)->vehicles;
        $bookings = [];

        foreach($allAgencyVehicles as $agencyVehicle) {
            if(!$agencyVehicle->bookings->where('active','=','1')->isEmpty())
            {
                foreach($agencyVehicle->bookings->where('active','=','1')->where('dateTime', '>', Carbon::today()->subDay())->where('dateTime','<=', Carbon::today()->addDay()) as $activeBooking)
                {
                    $booking = [];

                    $booking['id'] = $activeBooking['id'];
                    $booking['driver'] = Driver::find($activeBooking['driver_id'])->firstName.' '. Driver::find($activeBooking['driver_id'])->lastName;
                    $booking['vehicle'] = Vehicle::find($activeBooking['vehicle_id'])->matriculation;
                    $booking['halfDay'] = $activeBooking['halfDay'] == 1 ? 'morning' : 'afternoon';
                    $booking['trip_type'] = TripType::find($activeBooking['trip_type_id'])->name;

                    $bookings[] = $booking;
                }
            }
        }
        return $bookings;
    }

    public function getBookingsByCompany()
    {
        $companyBooking = [];
        $companyBookings = [];

        foreach (Auth::user()->company->bookings as $booking){
            if($booking->booking_status_id != 1) {
                $companyBooking['id'] = $booking->id;
                $companyBooking['driver'] = $booking->driver->lastName .' '.$booking->driver->firstName;
                $companyBooking['mail'] = $booking->driver->mail;
                $companyBooking['status'] = $booking->status->name;
                $companyBooking['company'] = $booking->company->name;
                $companyBooking['vehicle'] = $booking->vehicle->vehicleModel->name;
                $companyBooking['seats'] = $booking->vehicle->vehicleModel->seats;
                $companyBooking['dateTime'] = $booking->dateTime;
                $companyBooking['halfDay'] = $booking->halfDay;
                $companyBooking['tripType'] = $booking->triptype->name;
                $companyBookings[]= $companyBooking;
            }
        }

        return $companyBookings;
    }

    public function show(Booking $booking)
    {
        
        $companyBooking['id'] = $booking->id;
        $companyBooking['driver'] = $booking->driver->lastName .' '.$booking->driver->firstName;
        $companyBooking['mail'] = $booking->driver->mail;
        $companyBooking['status'] = $booking->status->name;
        $companyBooking['company'] = $booking->company->name;
        $companyBooking['vehicle'] = $booking->vehicle->vehicleModel->name;
        $companyBooking['seats'] = $booking->vehicle->vehicleModel->seats;
        $companyBooking['dateTime'] = $booking->dateTime;
        if ($booking->halfDay == 1){
            $companyBooking['halfDay'] = 'Matin';
        }
        else {
            $companyBooking['halfDay'] = 'Après-midi';
        }
        $companyBooking['tripType'] = $booking->triptype->name;

        return $companyBooking;

    }
    public function destroy(Booking $booking)
    {
        return $booking->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(AgencyController::findByName($request->agency));
        $booking = new Booking();

        $booking->agency_id = Agency::firstWhere('city',$request->agency)->id ;
        $booking->trip_type_id = $request->trip;
        if (empty($request->agencyArrived)){
            $booking->agencyArrived_id = Agency::firstWhere('city',$request->agency)->id ;
        }
        else{
            $booking->agencyArrived_id = Agency::firstWhere('city',$request->agencyArrived)->id ;
        }
        $booking->dateTime = $request->dateTime;
        $booking->halfDay = $request->half;
        $booking->active = 0;
        $booking->booking_status_id = 1;

        $booking->company_id = Auth::user()->company->id;
        return $booking->save();

    }

    public function findAgencyByName($anAgency){
        $agencies = Agency::all();
        $agencyId = 0;
        foreach ($agencies as $agency){
            if ($agency->city == $anAgency){
                $agencyId = $agency->id;
            }
        }
        return $agencyId;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function updateVehicleModel(Booking $booking, Request $request)
    {
        $data = Booking::find($booking->id);
        $model = VehicleModel::find($request->id);

        $vehicles = $model->vehicles;
        foreach ($vehicles as $vehicle){
            if ($vehicle->state->name == 'ready'){
                $data->vehicle_id = $vehicle->id;
            }

        }
        return $data->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function updateDriver(Booking $booking, Request $request)
    {
        $data = Booking::find($booking->id);
        $data->driver_id = $request->driver;
        $data->booking_status_id = 2;
        $vehicle = Vehicle::find($data->vehicle_id);
        $vehicle->state_id=3;
        $vehicle->save();
        return $data->save();
    }

    public function last()
    {
        $booking=Booking::latest('id')->first();
        $companyBooking['id'] = $booking->id;
        if ($booking->driver != null){
            $companyBooking['driver'] = $booking->driver;
            $companyBooking['mail'] = $booking->driver->mail;
        }
        else {
            $companyBooking['driver'] = null;
            $companyBooking['mail'] = null;
        }
        $companyBooking['status'] = $booking->status->name;
        $companyBooking['company'] = $booking->company->name;
        $companyBooking['vehicle'] = $booking->vehicle;
        $companyBooking['seats'] = $booking->vehicle;
        $companyBooking['dateTime'] = $booking->dateTime;
        if ($booking->halfDay == 1){
            $companyBooking['halfDay'] = 'Matin';
        }
        else {
            $companyBooking['halfDay'] = 'Après-midi';
        }
        $companyBooking['tripType'] = $booking->triptype->name;

        return $companyBooking;

    }

    public function showVehicleModel(Booking $booking)
    {

        $companyBooking['id'] = $booking->id;
        $companyBooking['driver'] = null ;
        $companyBooking['mail'] = null;
        $companyBooking['status'] = $booking->status->name;
        $companyBooking['company'] = $booking->company->name;
        $companyBooking['vehicle'] = null ;
        $companyBooking['seats'] = null ;
        $companyBooking['dateTime'] = $booking->dateTime;
        if ($booking->halfDay == 1){
            $companyBooking['halfDay'] = 'Matin';
        }
        else {
            $companyBooking['halfDay'] = 'Après-midi';
        }
        $companyBooking['tripType'] = $booking->triptype->name;

        return $companyBooking;

    }

    public function showDriver(Booking $booking)
    {

        $companyBooking['id'] = $booking->id;
        $companyBooking['driver'] = null;
        $companyBooking['mail'] = null;
        $companyBooking['status'] = $booking->status->name;
        $companyBooking['company'] = $booking->company->name;
        $companyBooking['vehicle'] = $booking->vehicle->vehicleModel->name;
        $companyBooking['seats'] = $booking->vehicle->vehicleModel->seats;
        $companyBooking['dateTime'] = $booking->dateTime;
        if ($booking->halfDay == 1){
            $companyBooking['halfDay'] = 'Matin';
        }
        else {
            $companyBooking['halfDay'] = 'Après-midi';
        }
        $companyBooking['tripType'] = $booking->triptype->name;

        return $companyBooking;

    }

}