<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function path()
    {
        return "#property-{$this->id}";
    }
}
