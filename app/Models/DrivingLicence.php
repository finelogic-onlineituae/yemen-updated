<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
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

    public function drivingLicenceCenter()
    {
        return $this->belongsTo(DrivingLicenceCenter::class);
    }

    public function vehicleCategory()
    {
        return $this->belongsTo(VehicleCategory::class);
    }
}
