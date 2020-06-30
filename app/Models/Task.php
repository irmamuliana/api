<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id','event_id','name'];

    public function event()
    {
        return $this->belongsTo('\App\Models\Event','event_id','id');
    }
}
