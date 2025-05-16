<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccin extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'name',
        'fabricant',
        'price',
    ];
    
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}