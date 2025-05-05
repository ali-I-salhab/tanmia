<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_of_support', 'supporter_id'];

    public function supporter()
    {
        return $this->belongsTo(Supporter::class);
    }
    public function plans()
{
    return $this->belongsToMany(Plan::class);
}

}
