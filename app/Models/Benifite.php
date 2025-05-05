<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benifite extends Model
{
    //
    protected $fillable = ['name', 'village', 'age'];

    protected $table = 'benifites';
    public function benifites()
{
    return $this->belongsToMany(Benifite::class);
}

}

// sssss
