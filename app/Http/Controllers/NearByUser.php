<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class NearByUser extends Controller
{
    public function NearbyUsers(Request $request)
    {
        
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'nullable|numeric', 
        ]);

        
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius', 10); // default radius is 10 KM

        // Calculate distance 
        $distanceFormula = "(6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";

        $users = User::select(DB::raw("*"))
            ->selectRaw("{$distanceFormula} AS distance")
            ->whereRaw("{$distanceFormula} < ?", [$radius])
            ->orderBy('distance', 'asc')
            ->get();

        // Check if users are found
        if ($users->isEmpty()) {
            return response()->json(['message' => 'No nearby users found'], 404);
        }

        // Return the list of nearby users
        return response()->json(['message' => 'Nearby users fetched successfully', 'data' => $users], 200);
    }
}
