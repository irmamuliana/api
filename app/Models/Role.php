<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['user_id','event_id','name'];

    public function event()
    {
        return $this->belongsTo('\App\Models\Event','event_id','id');
    }

    public function user()
    {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
}
