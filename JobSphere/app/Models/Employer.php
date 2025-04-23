<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    public function joblisting()
    {
        return $this->hasMany(Joblisting::class);
    }
}