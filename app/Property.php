<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function path()
    {
        return "#property-{$this->id}";
    }
}
