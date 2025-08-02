<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = [];
    
    public function formable()
    {
        return $this->morphTo();
    }
    
    public function applicant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function form_type()
    {
        return $this->belongsTo(FormType::class, 'form_type_id');
    }
}
