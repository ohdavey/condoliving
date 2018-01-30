@extends('layouts.app')

@section('content')
    <div class="container communities">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Tenants <small class="pull-right"><span class="label label-info">{{ count($tenants) }}</span></small></h2>
                    </div>
                    <div class="panel-body">

                        <div class="wrapper row">
                            
                            <div class="table-view col-md-12">
                                <table class="table table-bordered table-striped table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Lease</th>
                                        <th>Property</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tenants as $tenant)
                                        <tr>
                                            <td>{{ $tenant->id }}</td>
                                            <td>{{ $tenant->first_name }} {{ $tenant->last_name }}</td>
                                            <td>{{ $tenant->email }}</td>
                                            <td>{{ $tenant->phone }}</td>
                                            <td>{{ $tenant->lease->id}}</td>
                                            <td>{{ $tenant->property->id }}</td>
                                            <td>{{ $tenant->property->statusText() }}</td>
                                            <td>{{ $tenant->id }}</td>
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