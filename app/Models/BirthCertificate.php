<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BirthCertificate extends Model
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
   
    public function mothers_national()
    {
        return $this->belongsTo(Country::class,'mothers_nationality','id');
    }
    
    public function fathers_national()
    {
        return $this->belongsTo(Country::class,'fathers_nationality','id');
    }
}
