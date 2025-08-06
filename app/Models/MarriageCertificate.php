<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarriageCertificate extends Model
{
    protected $guarded = [];

    public function husbandPassport()
    {
        return $this->belongsTo(Passport::class, 'husband_passport_id');
    }

    public function wifePassport()
    {
        return $this->belongsTo(Passport::class, 'wife_passport_id');
    }

    public function passport()
    {
        return $this->belongsTo(Passport::class, 'passport_id');
    }
    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }

    // public function passport()
    // {
    //     return $this->belongsTo(Passport::class, 'passport_id');
    // }
}
