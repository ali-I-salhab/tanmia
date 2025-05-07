<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supporter extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'email'];
    public function plans()
{
    return $this->hasMany(\App\Models\Plan::class);
}
}
