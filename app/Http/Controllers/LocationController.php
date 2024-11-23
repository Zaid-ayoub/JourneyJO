<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Display all locations
    public function index()
    {
        // Fetch all locations (not soft deleted)
        $locations = Location::where('deleted', false)->get();

        // Pass locations to the view
        return view('location', compact('locations'));
    }

    // Show the form to create a new location
    public function create()
    {
        return view('add.add_location'); // The view where you want to show the form for adding a new location
    }

    // Store a new location
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'description' => 'required|string',
            'coordinates' => 'nullable|string', // Make coordinates optional
        ]);

        // Create a new Location instance
        $location = new Location();
        $location->location_name = $request->location_name;
        $location->description = $request->description;

        // If coordinates are provided, store them; otherwise, store null or an empty string
        $location->coordinates = $request->coordinates ?? null;  // If coordinates are empty, store null

        // Save the location to the database
        $location->save();

        // Redirect the user back to the locations list with a success message
        return redirect()->route('location')->with('success', 'Location added successfully!');
    }

    // Show the form to edit a location
    public function edit($id)
    {
        // Fetch the location by the primary key 'location_id'
        $location = Location::where('location_id', $id)->firstOrFail();
        return view('edit.edit_location', compact('location'));
    }


    // Update an existing location
    public function update(Request $request, $location_id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'location_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'coordinates' => 'nullable|string|max:255',
        ]);

        // Find the location by location_id
        $location = Location::where('location_id', $location_id)->firstOrFail();  // Make sure to use location_id here

        // Update the location with new data
        $location->update([
            'location_name' => $request->location_name,
            'description' => $request->description,
            'coordinates' => $request->coordinates,
        ]);

        return redirect()->route('location')->with('success', 'Location updated successfully');
    }

    // Soft delete a location
    public function destroy($location_id)
{
    // Find the location by location_id
    $location = Location::where('location_id', $location_id)->firstOrFail();

    // Set the deleted column to true (soft delete)
    $location->deleted = true;
    $location->save();  // Save the changes

    // Redirect back to the locations list
    return redirect()->route('location')->with('success', 'Location deleted successfully');
}
}