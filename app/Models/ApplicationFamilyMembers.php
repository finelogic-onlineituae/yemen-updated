<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationFamilyMembers extends Model
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

    public function familyMembers()
    {
        return $this->hasMany(ApplicationFamilyMemberspassport::class, 'family_member_id');
    }
}
