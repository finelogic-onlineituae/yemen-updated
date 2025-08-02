<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewPassport extends Model
{
    protected $guarded = [];
    
    public function form()
    {
        return $this->morphOne(Form::class, 'formable');
    }
}
