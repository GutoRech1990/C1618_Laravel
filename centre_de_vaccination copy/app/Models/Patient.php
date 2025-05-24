<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'name',
        'age',
        'adress',
        'birth_date',
    ];
    
    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}