<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The relationships to always eager-load.
     *
     * @var array
     */
    protected $with = ['creator', 'tenant', 'property'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    public static function boot()
    {
        parent::boot();

        Lease::created(function($lease){
            if ($lease->id) {
                $start    = (new \DateTime($lease->start_date));
                $end      = (new \DateTime($lease->end_date));
                $interval = \DateInterval::createFromDateString('1 month');
                $period   = new \DatePeriod($start, $interval, $end);

                foreach ($period as $dt) {
                    $rentLogs = new RentLog;
                    $rentLogs->lease_id = $lease->id;
                    $rentLogs->tenant_id = $lease->tenant_id;
                    $rentLogs->property_id = $lease->property_id;
                    $rentLogs->month = $dt;
                    $rentLogs->rent = $lease->monthly_rate;
                    $rentLogs->fee = 0;
                    $rentLogs->balance = $lease->monthly_rate;
                    $rentLogs->save();
                }
            }
        });
    }

    /**
     * A thread belongs to a creator.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * A Lease belongs to a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    /**
     * A Lease belongs to a Property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    /**
     * A Lease may have many rent logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rentLogs()
    {
        return $this->hasMany(RentLog::class);
    }
}
