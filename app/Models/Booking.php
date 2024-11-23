<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';

    protected $casts = [
        'booking_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'tour_id',
        'booking_date',
        'status',
        'total_price',
        'payment_status',
        'number_of_people',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Maps `user_id` to `id` in `users` table
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id', 'tour_id'); // Maps `tour_id` to `tour_id` in `tours` table
    }
}