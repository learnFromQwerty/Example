<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;

    protected $fillable = ['assistance_title', 'assistance_date'];

   // In Assistance model
public function users()
{
    return $this->belongsToMany(User::class, 'assistance_user', 'assistance_id', 'user_id');
}

    // In Assistance model
public function user()
{
    return $this->belongsTo(User::class);  // Adjust according to your actual foreign key
}

}
