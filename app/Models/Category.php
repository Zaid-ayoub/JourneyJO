<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id'; // Define the primary key if it's not the default 'id'
    protected $fillable = [
        'category_name',
        'category_image',
        'category_description',
        'deleted'
    ];

    // Optional: Define relationships (if any)
}