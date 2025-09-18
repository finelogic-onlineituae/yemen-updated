<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
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

    public function supportMembers()
    {
        return $this->hasMany(SupportMember::class, 'support_id');
    }
}
