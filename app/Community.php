<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return '/communities/' . $this->id;
    }

    /**
     * A Community may have many properties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function lowestPrice()
    {
        foreach ($this->properties as $property)
        {
            $prices[] = $property->price;
        }
        return min($prices);
    }

    /**
     * A Community belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
