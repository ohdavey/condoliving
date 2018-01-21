<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    public function path()
    {
        return '/communities/' . $this->id;
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
