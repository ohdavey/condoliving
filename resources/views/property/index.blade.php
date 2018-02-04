@extends('layouts.app')

@section('content')
    <div class="container communities">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Leases <small class="pull-right"><span class="label label-info"></span></small></h2>
                    </div>
                    <div class="panel-body">

                        <div class="wrapper row">
                            
                            <div class="table-view col-md-12">
                                <table class="table table-bordered table-striped table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>Unit</th>
                                        <th>Address</th>
                                        <th>Beds</th>
                                        <th>Baths</th>
                                        <th>Sqft</th>
                                        <th>Parking</th>
                                        <th>Year Built</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($properties as $property)
                                        <tr>
                                            <td>{{ $property->unit }}</td>
                                            <td>{{ $property->address }}. {{ $property->community->city }}, {{ $property->community->state }} {{ $property->community->postcode }}</td>
                                            <td>{{ $property->beds }}</td>
                                            <td>{{ $property->baths }}</td>
                                            <td>{{ $property->sqft }}</td>
                                            <td>{{ $property->parking }}</td>
                                            <td>{{ $property->year_built }}</td>
                                            <td>{{ $property->statusText() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection