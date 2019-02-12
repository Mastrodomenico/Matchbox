<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

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

    public function jobs(){
        return $this->belongsToMany(Job::class);
    }
}
