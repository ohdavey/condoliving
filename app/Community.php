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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return '/community/' . $this->id;
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
        $prices = array();
        foreach ($this->properties as $property)
        {
            $prices[] = $property->price;
        }
        return ($prices) ? min($prices) : 0;
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
