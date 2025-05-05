<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdLevelOne extends Model
{
    protected $fillable = ['name'];

    public function adLevelTwos()
    {
        return $this->hasMany(AdLevelTwo::class, 'ad_level_one_id');
    }
}