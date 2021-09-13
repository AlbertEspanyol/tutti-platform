<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     *@var array
     */
    protected $fillable = [
        'title',
        'subtitle',
        'location',
        'members',
        'financedState',
        'projectState',
        'needInvestment',
        'needRecruitment',
        'stake',
        'budget',
        'currentCash',
        'tags',
        'images',
        'isOnline',
        'introduction',
        'description',
        'partnerConditions',
        'investmentNeeds'
    ];
}
