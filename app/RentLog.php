<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentLog extends Model
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
     * A RentLog belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    /**
     * A RentLog belongs to a lease.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lease()
    {
        return $this->belongsTo(Lease::class, 'tenant_id');
    }

    /**
     * A RentLog belongs to a property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
