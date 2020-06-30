<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id','event_name','description','date'];

    public function user()
    {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
}
