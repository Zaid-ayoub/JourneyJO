<?php

namespace App\Http\Controllers;

use App\Models\TourImage;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\File;

class TourImageController extends Controller
{
    // Store additional images for a tour
    public function store(Request $request, $tourId)
    {
        // Validate the images
        $request->validate([
            'additional_images' => 'required|array',
            'additional_images.*' => 'image|mimes:jpg,jpeg,png,gif|max:10240', // image validation
        ]);

        // Find the tour to associate images with
        $tour = Tour::findOrFail($tourId);

        // Loop through the uploaded images and store them
        foreach ($request->file('additional_images') as $image) {
            // Get original file name and extension
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Create unique file name (original name + timestamp + extension)
            $uniqueFileName = $originalName . '_' . time() . '.' . $extension;

            // Move file to public/assets/img/tours folder
            $image->move(public_path('assets/img/tours'), $uniqueFileName);

            // Save the image to the database
            TourImage::create([
                'tour_id' => $tour->id,
                'image_path' => $uniqueFileName,
            ]);
        }

        return redirect()->route('tours.show', $tour->id)->with('success', 'Images uploaded successfully!');
    }

    // Optionally, you can add logic for deleting images if needed
    public function destroy($tourImageId)
    {
        $tourImage = TourImage::findOrFail($tourImageId);
        
        // Delete the image file from the folder
        if (File::exists(public_path('assets/img/tours/' . $tourImage->image_path))) {
            unlink(public_path('assets/img/tours/' . $tourImage->image_path));
        }

        // Delete the record from the database
        $tourImage->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}