<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date_limit',
        'number_jobs'
    ];

    public function candidates(){
        return $this->hasMany(Candidate::class);
    }
}