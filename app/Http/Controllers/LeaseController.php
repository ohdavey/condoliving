<?php

namespace App\Http\Controllers;

use App\Lease;
use App\Property;
use App\Tenant;
use App\Community;
use Illuminate\Http\Request;

class LeaseController extends Controller
{
    /**
     * Create a new ThreadsController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    public function create(Community $community, Property $property)
    {
        $this->authorize('update', $community);

        $preselected = false;
        if (isset($property)) {
            $properties = Property::where(['id' => $property->id, 'status' => '0', 'owner_id' => auth()->id()])->get(['id', 'address', 'unit', 'price']);
            $preselected = true;
        } else {
            // Get all properties that are vacant/available.
            $properties = Property::where(['status' => '0', 'owner_id' => auth()->id()])->get(['id', 'address', 'unit', 'price']);
        }
        return view('lease.create', compact('properties','preselected'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lease = new Lease;
        request()->validate($lease->rules());

        if (!$request->tenant_id) {
            $tenant = new Tenant;
            $tenant->property_id = $request->property_id;
            $tenant->personal_id = $request->personal_id;
            $tenant->first_name = $request->first_name;
            $tenant->last_name = $request->last_name;
            $tenant->email = $request->email;
            $tenant->phone = $request->phone;
            $tenant->dob = $request->dob;
            $tenant->salary = $request->salary;
            $tenant->status = 1;
        }
        else {
            $tenant = Tenant::where(['id' => $request->tenant_id, 'status' => '0'])->firstOrFail();
        }
        if ($tenant->save()) {
            $lease->create([
                'creator_id' => auth()->id(),
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
                'status' => 1,
                'notes' => request('notes'),
            ]);

            $property = Property::find($request->property_id);
            $property->status = 1;
            $property->save();
        }

        return view('lease.show', compact('lease'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        $this->authorize('update', $lease);
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
