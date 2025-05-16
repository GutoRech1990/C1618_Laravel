<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $fillable = [
        'vaccin_id',
        'patient_id',
        'vaccination_date',
    ];
    
    public function vaccin()
    {
        return $this->belongsTo(Vaccin::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}