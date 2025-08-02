<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportStatement extends Model
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

    public function PassportCenterName()
    {
        return $this->belongsTo(PassportCenter::class, 'beneficiary_issued_by');
    }
}
