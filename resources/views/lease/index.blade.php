@extends('layouts.app')

@section('content')
    <div class="container leases">
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
                                        <th>#</th>
                                        <th>Deposit</th>
                                        <th>Monthly Rate</th>
                                        <th>Late Fee</th>
                                        <th>Mnt Fee</th>
                                        <th>Amenities</th>
                                        <th>Start Date</th>
                                        <th>Expiration Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leases as $lease)
                                        <tr>
                                            <td>{{ $lease->id }}</td>
                                            <td>{{ $lease->deposit }}</td>
                                            <td>{{ $lease->monthly_rate }}</td>
                                            <td>{{ $lease->late_fee }}</td>
                                            <td>{{ $lease->maintenance_fee }}</td>
                                            <td>{{ $lease->amenities }}</td>
                                            <td>{{ $lease->start_date }}</td>
                                            <td>{{ $lease->end_date }}</td>
                                            <td>{{ $lease->status }}</td>
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