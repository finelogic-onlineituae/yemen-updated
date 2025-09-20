<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoIdentityCard extends Model
{
    protected $guarded = [];
    public function groupIdCardMembers()
    {
        return $this->hasMany(GroupIdCardMember::class);
    }
}
