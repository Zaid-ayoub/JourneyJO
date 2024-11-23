<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Category;
use App\Models\User;
use App\Models\TourImage;
use Illuminate\Http\Request;


class TourController extends Controller
{
    public function index()
{
    $user = auth()->user(); // Get the logged-in user

    if ($user->role_id == 3) {
        // Admin: Fetch all tours (deleted = false)
        $tours = Tour::with(['company', 'category', 'images'])->where('deleted', false)->get();
    } elseif ($user->role_id == 2) {
        // Company: Fetch only tours created by the logged-in company
        $tours = Tour::with(['company', 'category', 'images'])
            ->where('deleted', false)
            ->where('company_id', $user->id) // Match the logged-in user's ID
            ->get();
    } else {
        // Other roles: Fetch no tours (or customize as needed)
        $tours = collect(); // Empty collection
    }

    return view('tour', compact('tours'));
}



    public function create()
    {
        $categories = Category::where('deleted', false)->get();
        $companies = User::all(); // Assuming users can act as companies
        return view('add.add_tour', compact('categories', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'additional_images' => 'nullable|array',
            'additional_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'available_seats' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,category_id', // Ensure category_id is required and valid
        ]);

        // Create the tour
        $tour = new Tour();
        $tour->name = $request->name;
        $tour->price = $request->price;
        $tour->description = $request->description;
        $tour->start_date = $request->start_date;
        $tour->end_date = $request->end_date;
        $tour->available_seats = $request->available_seats;
        $tour->category_id = $request->category_id; // Save the selected category ID
        $tour->company_id = auth()->id();

        // Handle the cover image
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '.' . $coverImage->getClientOriginalExtension();
            $coverImage->move(public_path('assets/img/tours'), $coverImageName);
            $tour->cover_image = $coverImageName;
        }

        $tour->save();

        // Handle additional images
        if ($request->hasFile('tour_images')) {
            foreach ($request->file('tour_images') as $image) {
                // Generate a unique file name
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $uniqueFileName = $originalName . '_' . time() . '.' . $extension;

                // Move the image to the public folder
                $image->move(public_path('assets/img/tour_images'), $uniqueFileName);

                // Save the image path in the tour_images table
                TourImage::create([
                    'tour_id' => $tour->tour_id,
                    'image_path' => $uniqueFileName,
                ]);
            }
        }

        return redirect()->route('tour')->with('success', 'Tour created successfully!');
    }

    public function show($tour_id)
    {
        $tour = Tour::findOrFail($tour_id); // Use tour_id here
        return view('tour.show', compact('tour'));
    }

    public function edit($id)
    {
        // Fetch the tour along with the associated images
        $tour = Tour::with('images')->find($id);

        // Check if the tour is found
        if (!$tour) {
            return redirect()->route('tour.index')->with('error', 'Tour not found');
        }

        // Fetch categories from the database
        $categories = Category::where('deleted', false)->get();

        // Pass the tour and categories to the view
        return view('edit.edit_tour', compact('tour', 'categories'));
    }





    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'available_seats' => 'required|integer',
            'cover_image' => 'nullable|image|max:10240',
            'tour_images.*' => 'nullable|image|max:10240',
        ]);

        // Find the tour by ID
        $tour = Tour::find($id);

        if (!$tour) {
            return redirect()->route('tour')->with('error', 'Tour not found');
        }

        // Update the tour fields
        $tour->name = $request->name;
        $tour->price = $request->price;
        $tour->category_id = $request->category_id;
        $tour->start_date = $request->start_date;
        $tour->end_date = $request->end_date;
        $tour->available_seats = $request->available_seats;
        $tour->description = $request->description;

        // Handle cover image update
        if ($request->hasFile('cover_image')) {
            $coverImage = $request->file('cover_image');
            $coverImageName = time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(public_path('assets/img/tours'), $coverImageName);

            // Delete the old cover image if it exists
            if ($tour->cover_image) {
                unlink(public_path('assets/img/tours/' . $tour->cover_image));
            }

            // Save new cover image path
            $tour->cover_image = $coverImageName;
        }

        // Save the tour
        $tour->save();

        // Handle additional images update
        if ($request->hasFile('tour_images')) {
            foreach ($request->file('tour_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('assets/img/tour_images'), $imageName);

                // Save image path to the database
                TourImage::create([
                    'tour_id' => $tour->tour_id,
                    'image_path' => $imageName,
                ]);
            }
        }

        return redirect()->route('tour')->with('success', 'Tour updated successfully!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->deleted = true; // Set deleted column to true
        $tour->save();

        return redirect()->route('tour')->with('success', 'Tour marked as deleted.');
    }
}