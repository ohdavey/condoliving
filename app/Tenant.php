<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * A Tenant lives in a property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    /**
     * A Tenant has a lease.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lease()
    {
        return $this->hasOne(Lease::class, 'tenant_id');
    }

    /**
     * A Tenant may have many rent logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rentLogs()
    {
        return $this->hasMany(RentLog::class);
    }

    /**
     * A Tenant may have many payments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
