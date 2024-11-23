<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactUsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');






Route::get('/users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/add-user', function () {
    return view('add.add_user');
})->middleware(['auth', 'verified'])->name('add_user');

// Show Add User Form
Route::get('/add-user', [UserController::class, 'create'])->name('add_user');

// Store New User
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Edit User Info
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('edit_user');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// edit deleted cloumn on the DB
Route::post('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');


// Show Categories (Listing categories)
Route::get('/category', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('category');

// Show Add Category Form
Route::get('/add-category', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('add_category');

// Store New Category
Route::post('/category', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('categories.store');

// Edit Category Form
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('categories.edit');

// Update Category
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('categories.update');


// Soft Delete Category
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('categories.delete');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/tour', [TourController::class, 'index'])->name('tour');
    Route::get('/add-tour', [TourController::class, 'create'])->name('add_tour');
    Route::post('/tour', [TourController::class, 'store'])->name('tours.store');
    Route::get('/tour/edit/{id}', [TourController::class, 'edit'])->name('tours.edit');
    Route::put('/tour/update/{id}', [TourController::class, 'update'])->name('tours.update');
    Route::post('/tour/delete/{id}', [TourController::class, 'destroy'])->name('tours.delete');
});


Route::get('/booking', [BookingController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('booking');

Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('booking.edit');

Route::patch('/booking/update/{id}', [BookingController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('booking.update');


Route::get('/location', [LocationController::class, 'index'])->middleware(['auth', 'verified'])->name('location');

// Show Add Location Form
Route::get('/add-location', [LocationController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('add_location');

// Store New Location
Route::post('/location', [LocationController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('locations.store');

// Edit Location Form
Route::get('/location/edit/{id}', [LocationController::class, 'edit'])->middleware(['auth', 'verified'])->name('locations.edit');

// Update Location
Route::put('/location/update/{location_id}', [LocationController::class, 'update'])->middleware(['auth', 'verified'])->name('locations.update');

// delete location
Route::post('/location/delete/{location_id}', [LocationController::class, 'destroy'])->name('locations.delete');


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact_us');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact.show');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';