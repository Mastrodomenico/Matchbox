<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_birth',
        'cpf',
        'institution_graduation',
        'course_graduation',
        'year_graduation'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
