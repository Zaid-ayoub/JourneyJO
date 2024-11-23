<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'tour_images';

    // Set the fillable fields
    protected $fillable = [
        'tour_id',
        'image_path',
    ];

    // Define the relationship between TourImage and Tour

public function tour()
{
    return $this->belongsTo(Tour::class, 'tour_id', 'id');
}

}