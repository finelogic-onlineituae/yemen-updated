<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoIdCard extends Model
{
    protected $guarded = [];
    public function passport()
    {
        return $this->belongsTo(Passport::class, 'passport_id');
    }
}
