<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdLevelThree extends Model
{
    protected $fillable = ['name', 'ad_level_two_id'];

    public function adLevelTwo()
    {
        return $this->belongsTo(AdLevelTwo::class, 'ad_level_two_id');
    }
}
