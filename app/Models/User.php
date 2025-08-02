<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guarded = [''];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function passports()
    {
        return $this->hasMany(Passport::class)->orderBy('used_from', 'desc');
    }

    

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function updatePassport(Passport $passport)
    {
        $user = auth()->user();
        if(!session()->has('passport_id'))
        {
            $passport = $user->passports()->create([
                'passport_number' => $passport->passport_number,
                'issued_by' => $passport->issued_by,
                'passport_center_id' => $passport->passport_center_id,
                'issued_on' => $passport->issued_on,
                'expires_on' => $passport->expires_on,
                'attachment' => $passport->attachment,
            ]);
            session(['passport_id' => $passport->id]);
            return $passport;
        }
        else{
            $passportToUpdate = Passport::find(session('passport_id'));
            if(!$passportToUpdate)
            {
                abort(403);
            }
            $passportToUpdate->passport_number = $passport->passport_number;
            $passportToUpdate->issued_by = $passport->issued_by;
            $passportToUpdate->passport_center_id = $passport->passport_center_id;
            $passportToUpdate->issued_on = $passport->issued_on;
            $passportToUpdate->expires_on = $passport->expires_on;
            $passportToUpdate->attachment = $passport->attachment;
            $passportToUpdate->save();
            
            return $passportToUpdate;
        }
    }

    public function isYemenNational()
    {
        return auth()->user()->nationality == 'YE';
    }
    public function hasPassport()
    {
        return $this->passports()->exists();
    }
}
