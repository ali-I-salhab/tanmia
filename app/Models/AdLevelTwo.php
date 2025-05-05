<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdLevelTwo extends Model
{
    protected $fillable = ['name', 'ad_level_one_id'];

    public function adLevelOne()
    {
        return $this->belongsTo(AdLevelOne::class, 'ad_level_one_id');
    }

    public function adLevelThrees()
    {
        return $this->hasMany(AdLevelThree::class, 'ad_level_two_id');
    }
}
