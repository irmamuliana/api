<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['event_id','name','date'];

    public function event()
    {
        return $this->belongsTo('\App\Models\Event','event_id','id');
    }
}
