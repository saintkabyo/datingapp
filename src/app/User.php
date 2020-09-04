<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DateTime;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function age()
    {
        return DateTime::createFromFormat('Y-m-d', $this->dob)
        ->diff(new DateTime('now'))
        ->y;
    }

    public function distance()
    {
        $latFrom = deg2rad(auth()->user()->latitude);
        $lonFrom = deg2rad(auth()->user()->longitude);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);
        
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
      
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return ceil($angle * 6371);
    }

    public function scopeNearby($query)
    {
        $unit = 6371;
        $lat = auth()->user()->latitude;
        $lng = auth()->user()->longitude;
        $radius = 200;

        $sql =  "($unit * ACOS(COS(RADIANS($lat))
                * COS(RADIANS(latitude))
                * COS(RADIANS($lng) - RADIANS(longitude))
                + SIN(RADIANS($lat))
                * SIN(RADIANS(latitude))))";

        return $query->whereRaw($sql.'<='.$radius)
            ->select(\DB::raw("*, $sql AS distance")
            )->orderBy('distance','asc');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function liked()
    {
        return auth()->user()->likes()->where('target_user_id',$this->id)->where('liked',1)->exists();
    }

    public function disliked()
    {
        return auth()->user()->likes()->where('target_user_id',$this->id)->where('liked',0)->exists();
    }

    public function likedme()
    {   
        return $this->likes()->where('target_user_id',auth()->user()->id)->where('liked',1)->exists();
    }

    public function matched()
    {
        return $this->liked() && $this->likedme();
    }
}
