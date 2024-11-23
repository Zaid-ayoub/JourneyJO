<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Specify the table if it doesn't match the model name convention
    protected $table = 'roles';

    // Specify fillable attributes for mass assignment
    protected $fillable = ['role_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}