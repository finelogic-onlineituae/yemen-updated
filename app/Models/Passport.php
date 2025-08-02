<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{

    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function passportCenter()
    {
        return $this->belongsTo(PassportCenter::class);
    }

    public function country_main()
    {
        return $this->belongsTo(Country::class,'issued_by');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'issued_by');
    }

    public function BirthCertificate()
    {
        return $this->hasMany(BirthCertificate::class);
    }
}
