<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    const STATUS_VACANT     = 0;
    const STATUS_RENTED     = 1;
    const STATUS_DEFAULT    = 2;
    const STATUS_EVICTION   = 3;
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A Property has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    /**
     * A Property has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function path()
    {
        return "/community/{$this->community_id}/property/{$this->id}";
    }

    public function statusOptions()
    {
        return array(
            self::STATUS_VACANT   => 'Vacant',
            self::STATUS_RENTED   => 'Rented',
            self::STATUS_DEFAULT  => 'Default',
            self::STATUS_EVICTION => 'Eviction',
        );
    }

    public function statusText()
    {
        $options = $this->statusOptions();
        return isset( $options[$this->status]) ? $options[$this->status] : "unknown ({$this->status})";
    }
}
