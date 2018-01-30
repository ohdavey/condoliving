@extends('layouts.app')

@section('content')
    <div class="container property">
        <h2 class="page-header">
            Lease for {{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}<span class="pull-right label label-info">{{ $lease->status }}</span>
        </h2>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div><strong>Start Date:</strong> {{ date('d-m-Y', strtotime($lease->start_date)) }}</div>
                        <div><strong>Expiration Date:</strong> {{ date('d-m-Y', strtotime($lease->start_date)) }}</div>
                        <div><strong>Monthly Rate:</strong> ${{ $lease->monthly_rate }}</div>
                        <div><strong>Deposit:</strong> ${{ $lease->deposit }}</div>
                        <div><strong>Late Fee:</strong> {{ ($lease->late_fee * 100) }}%</div>
                        <div><strong>Maintenance Fee:</strong> ${{ $lease->maintenance_fee }}</div>
                    </div>
                    <div class="col-sm-8">
                        <h3 class="panel-title">
                            <strong>Notes:</strong>
                        </h3>
                        <p>{{ $lease->notes }}</p>

                        <p><strong>Amenities:</strong> <br>{{ $lease->amenities }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="row">

                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-drivers-license-o"></i> Tenant Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="">
                                    <div class="thumbnail">
                                        <img class="img-responsive img-circle img-thumbnail" src="https://picsum.photos/130/130/?person" alt="">
                                        <div class="caption text-center">
                                            <h3 class="panel-title"><strong>{{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}</strong></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center"></div>
                            </div>
                            <div class="col-sm-7">
                                <label>Identification:</label> {{ $lease->tenant->ssn }}<br>
                                <label>Birth Date:</label> {{ date('d-m-Y', strtotime($lease->tenant->dob)) }}<br>
                                <label>Email:</label> {{ $lease->tenant->email }}<br>
                                <label>Phone:</label> {{ $lease->tenant->phone }}<br>
                                <label>Salary:</label> ${{ $lease->tenant->salary}}<br>
                                <label>Status:</label> {{ $lease->tenant->property->statusText() }}<br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-building-o"></i> Property Details</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-bed"></i> {{ $lease->property->beds }} Bedroom
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-bath"></i> {{ $lease->property->baths }} Bathroom
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-minus-square-o"></i> {{ $lease->property->sqft}} Sqft.
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-car"></i> {{ $lease->property->parking }} Car Garage
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-calendar-o"></i> Built {{ $lease->property->year_built}}
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-fw fa-1x fa-home"></i> {{ $lease->property->type}}
                            </div>
                        </div>

                        <h3><small>Price</small><br/><strong>${{ $lease->property->price }}</strong><small>/month</small></h3>

                        <p>
                            <i class="fa fa-map-marker"></i>
                            {{ $lease->property->address }}<br>
                            {{ $lease->property->community->city }}, {{ $lease->property->community->state }} {{ $lease->property->community->postcode }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection