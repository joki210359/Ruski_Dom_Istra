<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['other_column', 'created_at'];  // Dodaj sve atribute koje koristiš

    // Automatska konverzija Unix timestamp-a u DATETIME format
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::createFromTimestamp($value)->toDateTimeString();
    }
}

