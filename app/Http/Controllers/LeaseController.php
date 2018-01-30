<?php

namespace App\Http\Controllers;

use App\Lease;
use App\Property;
use App\RentLog;
use App\Tenant;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Create a new ThreadsController instance.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leases = Lease::all();

        return view('lease.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get all properties that are vacant/available.
        $properties = Property::where('status', '=', '0')->get(['id', 'address', 'unit', 'price']);
        return view('lease.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'property_id' => 'required|numeric',
            'deposit' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'monthly_rate' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'late_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'maintenance_fee' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'amenities' => 'required|regex:/([a-zA-Z0-9]+,)?[a-zA-Z0-9]+/',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'due_day' => 'required|numeric',
            'notes' => 'required|string',
            'ssn' => 'required|unique:tenants',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required|date|before:-18year',
            'salary' => 'required|regex:/([a-zA-Z0-9]+,)?[a-zA-Z0-9]+/',
        ]);

        $tenant = new Tenant;

        $tenant->property_id = $request->property_id;
        $tenant->ssn = $request->ssn;
        $tenant->first_name = $request->first_name;
        $tenant->last_name = $request->last_name;
        $tenant->email = $request->email;
        $tenant->phone = $request->phone;
        $tenant->dob = $request->dob;
        $tenant->salary = $request->salary;

        if ($tenant->save()) {
            $lease = Lease::create([
                'creator_id' => 1,
                'property_id' => request('property_id'),
                'tenant_id' => $tenant->id,
                'deposit' => request('deposit'),
                'monthly_rate' => request('monthly_rate'),
                'late_fee' => request('late_fee'),
                'maintenance_fee' => request('maintenance_fee'),
                'amenities' => request('amenities'),
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
                'due_day' => request('due_day'),
                'status' => 0,
                'notes' => request('notes'),
            ]);

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
        }

        return view('lease.index', compact('leases'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        return view('lease.show', compact('lease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function edit(Lease $lease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lease $lease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lease $lease)
    {
        //
    }
}
