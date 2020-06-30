<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['event_id','image'];

    public function event()
    {
        return $this->belongsTo('\App\Models\Event','event_id','id');
    }
}
