<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerOfAttorney extends Model
{
    protected $guarded = [];

    public function clientPassport()
    {
        return $this->belongsTo(Passport::class, 'client_passport_id');
    }

    public function agentPassport()
    {
        return $this->belongsTo(Passport::class, 'agent_passport_id');
    }
}
