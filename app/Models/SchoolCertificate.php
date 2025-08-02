<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolCertificate extends Model
{
    protected $guarded = [];
    
    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }

    public function passport()
    {
        return $this->belongsTo(Passport::class, 'passport_id');
    }

    public function guardian()
    {
        return $this->belongsTo(Passport::class, 'guardian_passport_id');
    }
}
