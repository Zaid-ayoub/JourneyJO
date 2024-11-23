<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{


    // Display the list of categories
    public function index()
    {
        $categories = Category::where('deleted', false)->get(); // Fetch categories that are not deleted
        return view('category', compact('categories')); // Pass categories to the view
    }

    // Show the form to create a new category
    public function create()
    {
        return view('add.add_category');
    }

    // Store a newly created category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name|max:100',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
            'category_description' => 'nullable|string',
        ]);
    
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
    
        if ($request->hasFile('category_image')) {
            // Get original file name and extension
            $originalName = pathinfo($request->file('category_image')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('category_image')->getClientOriginalExtension();
    
            // Create unique file name (original name + timestamp + extension)
            $uniqueFileName = $originalName . '_' . time() . '.' . $extension;
    
            // Move file to public/assets/img folder
            $request->file('category_image')->move(public_path('assets/img'), $uniqueFileName);
    
            // Save only the file name in the database
            $category->category_image = $uniqueFileName;
        }
    
        $category->save();
    
        return redirect()->route('category')->with('success', 'Category created successfully!');
    }
    

    // Show the form to edit a category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('edit.edit_category', compact('category'));
    }

    // Update the category
    public function update(Request $request, $id)
{
    $request->validate([
        'category_name' => 'required|max:255',
        'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:10240',
        'category_description' => 'nullable|string',
    ]);

    $category = Category::findOrFail($id);

    $category->category_name = $request->category_name;
    $category->category_description = $request->category_description;

    if ($request->hasFile('category_image')) {
        // Delete old image if it exists
        if ($category->category_image && file_exists(public_path('assets/img/' . $category->category_image))) {
            unlink(public_path('assets/img/' . $category->category_image));
        }

        // Get original file name and extension
        $originalName = pathinfo($request->file('category_image')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('category_image')->getClientOriginalExtension();

        // Create unique file name
        $uniqueFileName = $originalName . '_' . time() . '.' . $extension;

        // Move file to public/assets/img folder
        $request->file('category_image')->move(public_path('assets/img'), $uniqueFileName);

        // Save only the file name in the database
        $category->category_image = $uniqueFileName;
    }

    $category->save();

    return redirect()->route('category')->with('success', 'Category updated successfully!');
}


    // Soft delete the category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->deleted = true; // Mark as deleted (soft delete)
        $category->save(); // Save the soft delete status
        return redirect()->route('category')->with('success', 'Category deleted successfully!'); // Redirect
    }
}