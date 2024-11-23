<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // The table associated with the model (optional if it follows Laravel's naming convention)
    protected $table = 'locations';

    protected $primaryKey = 'location_id'; // Explicitly set the primary key
    public $incrementing = false; // Set to false if the primary key is not auto-incrementing

    // The attributes that are mass assignable (you can specify which fields can be mass assigned)
    protected $fillable = [
        'location_name', 
        'description', 
        'coordinates',
        'deleted'
    ];

    // Optionally, if you need to set timestamps explicitly
    public $timestamps = true;
}