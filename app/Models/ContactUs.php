<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_us';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_email',
        'message',
    ];

    /**
     * Get the user who submitted the contact message.
     */
    // In ContactUs.php model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}