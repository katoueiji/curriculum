<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function userDate() 
    {
        return $this->hasOne('App\userDate', 'user_id', 'id');
    }

    public function Event() 
    {
        return $this->hasMany('App\Event', 'user_id', 'id');
    }

    public function Event_user() 
    {
        return $this->hasMany('App\Event_user', 'user_id', 'id');
    }

    public function Reports() 
    {
        return $this->hasMany(Reports::class);
    }

    public function Bookmark() {
        return $this->hasMany('App\Bookmark', 'user_id', 'id');
    }

    public function Bookmark_event() {
        return $this->belongsToMany('App\Event', 'bookmarks', 'user_id', 'event_id');
    }

    public function is_Bookmark() {
        return $this->hasMany(Bookmark::class);
    }
    public function Events()
    {
        return $this->belongsToMany(Event::class, 'event_users', 'user_id', 'event_id');
    }
}
