<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class fetchNearbyUser extends Controller
{
    public function fetchNearbyUsers(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = 15; //   <-- distance 15km 

        // Query to fetch nearby users based on latitude, longitude, and radius
        $nearbyUsers = User::select(DB::raw("id, name, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance"))
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->setBindings([$latitude, $longitude, $latitude])
            ->get();

        return response()->json(['users' => $nearbyUsers]);
    }
}
