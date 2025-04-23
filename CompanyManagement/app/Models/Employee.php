<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    protected $fillable = [
        'first_name',
        'last_name',
        'matricule',
        'company_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}