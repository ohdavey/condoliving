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
                                        <th>Tenant</th>
                                        <th>Property</th>
                                        <th>Deposit</th>
                                        <th>Monthly Rate</th>
                                        <th>Late Fee</th>
                                        <th>Mnt. Fee</th>
                                        <th>Term Dates</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leases as $lease)
                                        <tr>
                                            <td><a href="{{ $lease->path() }}">{{ $lease->id }}</a></td>
                                            <td><a href="{{ $lease->tenant->path() }}">{{ $lease->tenant->first_name }} {{ $lease->tenant->last_name }}</a></td>
                                            <td><a href="{{ $lease->property->path() }}">{{ $lease->property->address }}</a></td>
                                            <td>${{ number_format($lease->deposit) }}</td>
                                            <td>${{ number_format($lease->monthly_rate) }}</td>
                                            <td>${{ number_format($lease->maintenance_fee) }}</td>
                                            <td>{{ number_format($lease->late_fee) * 1 }}%</td>
                                            <td>{{ date('d-m-Y', strtotime($lease->start_date)) }} - {{ date('d-m-Y', strtotime($lease->end_date)) }}</td>
                                            <td>{{ $lease->statusText() }}</td>
                                            <td>
                                                <a href="{{ $lease->path() }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a href="{{ $lease->path() }}"><i class="fa fa-fw fa-pencil-square-o text-warning"></i></a>
                                                <a href="{{ $lease->path() }}"><i class="fa fa-fw fa-times text-danger"></i></a>
                                            </td>
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