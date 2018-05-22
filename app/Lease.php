<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'property_id' => 'required|numeric',
            'deposit' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'monthly_rate' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'late_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'maintenance_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'amenities' => 'required|regex:/([a-zA-Z0-9]+,)?[a-zA-Z0-9]+/',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'due_day' => 'required|numeric',
            'notes' => 'required|string',
            'personal_id' => 'required_if:tenant_id,0',
            'first_name' => 'required_if:tenant_id,0|string',
            'last_name' => 'required_if:tenant_id,0|string',
            'email' => 'required_if:tenant_id,0|email',
            'phone' => 'required_if:tenant_id,0',
            'dob' => 'required_if:tenant_id,0|date|before:-18year',
            'salary' => 'required_if:tenant_id,0|regex:/([a-zA-Z0-9]+,)?[a-zA-Z0-9]+/',
        ];
    }

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
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/lease/{$this->id}";
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
