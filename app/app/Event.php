<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function User()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function Event_user()
    {
        return $this->hasMany('App\Event_user', 'event_id', 'id');
    }

        public function Reports()
    {
        return $this->hasMany(Reports::class);
    }

    public function bookmark() {
        return $this->hasMany(bookmark::class);
    }

    public function Users()
    {
        return $this->belongsToMany(User::class, 'event_users', 'event_id', 'user_id');
    }
}
