<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public static function withoutYemen()
    {
        return self::where('country_code', '!=', 'YE')->get();
    }
}
