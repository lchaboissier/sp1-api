<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\User  $user
     * @return array
     */
    public function show(int $userId)
    {
        $data = User::find($userId);

        $user = [];

        $user['first_name'] = $data->firstName;
        $user['last_name'] = $data->lastName;
        $user['email'] = $data->email;
        $user['role'] = $data->role->name;
        if ($data->agency){
            $user['agency'] = $data->agency->city;
        }

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function updatePassword(Request $request)
    {

        $data = $request->all(['old_password', 'new_password', 'user_id']);
        $user = User::find($data['user_id']);

        if(Hash::check($data['old_password'], $user->password)){
            if(Hash::check($data['new_password'], $user->password)){
                return 'error';
            }else{
                $user->password = Hash::make($data['new_password']);
                $user->save();
                return 'success';
            }
        }else{
            return 'wrongPassword';
        }
    }

    public function allClients()
    {
        $clients = User::whereIn('role_id', [3, 4])->get();

        $clientsToReturn = [];

        foreach($clients as $client) {
            $clientToReturn = [];

            $clientToReturn['id'] = $client['id'];
            $clientToReturn['name'] = $client['firstName'].' '.$client['lastName'];

            $clientsToReturn[] = $clientToReturn;
        }
        return $clientsToReturn;
    }
}
