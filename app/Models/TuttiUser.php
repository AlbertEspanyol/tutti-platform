<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuttiUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'email',
        'pasword',
        'birthday',
        'userType',
        'isPremium'
    ];
}
