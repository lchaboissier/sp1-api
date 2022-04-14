<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\BookingStatus;
use App\Models\Company;
use App\Models\Driver;
use App\Models\State;
use App\Models\User;
use App\Models\Vehicle;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function setVehicleState($vehicleId, $state)
    {
        Vehicle::find($vehicleId)->update(['state_id' => $state]);

        return Vehicle::find($vehicleId);
    }

    public function vehiclesForClient($clientId, $halfDay, $bookingStatusId)
    {
        $vehicles = [];
        $allAwaitingBookings = User::find($clientId)->company->bookings->where('halfDay', '=', $halfDay)->where('booking_status_id', '=', $bookingStatusId);
        foreach ($allAwaitingBookings as $awaitingBooking)
        {
            $vehicle = [];

            $vehicle['id'] = $awaitingBooking->vehicle->id;
            $vehicle['vehicle_model'] = VehicleModel::find($awaitingBooking->vehicle['vehicle_model_id'])->name;
            $vehicle['matriculation'] = $awaitingBooking->vehicle->matriculation;
            $vehicle['client_company'] = $awaitingBooking->company->name;
            $vehicle['driver'] = Driver::find($awaitingBooking->driver_id)->firstName.' '.Driver::find($awaitingBooking->driver_id)->lastName;
            $vehicle['state'] = $awaitingBooking->vehicle->state->name;
            $vehicle['booking_status'] = BookingStatus::find($bookingStatusId)->name;

            $vehicles[] = $vehicle;
        }

        return $vehicles;
    }

    public function vehiclesToWithdrawForClient($clientId, $agencyId)
    {
        $vehicles = [];
        $company = User::find($clientId)->company;
        $allAwaitingToWithdrawBookings = $company->bookings->where('agency_id', '=', $agencyId);
        foreach ($allAwaitingToWithdrawBookings as $awaitingToWithdrawBooking)
        {
            $vehicle = [];
            $vehicleModel = VehicleModel::find($awaitingToWithdrawBooking->vehicle['vehicle_model_id']);

            $vehicle['id'] = $awaitingToWithdrawBooking->vehicle->id;
            $vehicle['vehicle_model'] = $vehicleModel->brand->name.' '.$vehicleModel->name;
            $vehicle['matriculation'] = $awaitingToWithdrawBooking->vehicle->matriculation;
            $vehicle['client_company'] = $awaitingToWithdrawBooking->company->name;
            $vehicle['driver'] = Driver::find($awaitingToWithdrawBooking->driver_id)->firstName.' '.Driver::find($awaitingToWithdrawBooking->driver_id)->lastName;
            $vehicle['state'] = $awaitingToWithdrawBooking->vehicle->state->name;

            if (!($vehicle['state']=="controlled_on_return")) {
                $vehicles[] = $vehicle;
            }
        }
        return $vehicles;
    }

    public function vehiclesToReturnForClient($clientId, $agencyId)
    {
        $vehicles = [];
        $company = User::find($clientId)->company;
        $allAwaitingToReturnBookings = $company->bookings->where('agency_id', '=', $agencyId);
        foreach ($allAwaitingToReturnBookings as $awaitingToReturnBooking)
        {
            $vehicle = [];
            $vehicleModel = VehicleModel::find($awaitingToReturnBooking->vehicle['vehicle_model_id']);

            $vehicle['id'] = $awaitingToReturnBooking->vehicle->id;
            $vehicle['vehicle_model'] = $vehicleModel->brand->name.' '.$vehicleModel->name;
            $vehicle['matriculation'] = $awaitingToReturnBooking->vehicle->matriculation;
            $vehicle['client_company'] = $awaitingToReturnBooking->company->name;
            $vehicle['driver'] = Driver::find($awaitingToReturnBooking->driver_id)->firstName.' '.Driver::find($awaitingToReturnBooking->driver_id)->lastName;
            $vehicle['state'] = $awaitingToReturnBooking->vehicle->state->name;

            if (!($vehicle['state']=="to_prepare")) {
                if (!($vehicle['state']=="ready")) {
                    $vehicles[] = $vehicle;
                }
            }
        }

        return $vehicles;
    }
}
