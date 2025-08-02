<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaApplication extends Model
{
    protected $guarded = [];
    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'country_code');
    }

    public function passport()
    {
        return $this->belongsTo(Passport::class, 'passport_id');
    }

    public function AccompanyMembers()
    {
        return $this->hasMany(VisaApplicationAccompany::class, 'visa_application_id');
    }
}
