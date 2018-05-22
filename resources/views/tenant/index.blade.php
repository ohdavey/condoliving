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
                                            <td><a href="{{ $tenant->path() }}">{{ $tenant->id }}</a></td>
                                            <td><a href="{{ $tenant->path() }}">{{ $tenant->first_name }} {{ $tenant->last_name }}</a></td>
                                            <td>{{ $tenant->email }}</td>
                                            <td>{{ $tenant->phone }}</td>
                                            <td><a href="{{ $tenant->lease->path() }}">{{ $tenant->lease->id}}</a></td>
                                            <td><a href="{{ $tenant->property->path() }}">{{ $tenant->property->address }}</a></td>
                                            <td>{{ $tenant->property->statusText() }}</td>
                                            <td>
                                                <a href="{{ $tenant->path() }}"><i class="fa fa-fw fa-eye"></i></a>
                                                <a href="{{ $tenant->path() }}"><i class="fa fa-fw fa-pencil-square-o text-warning"></i></a>
                                                <a href="{{ $tenant->path() }}"><i class="fa fa-fw fa-times text-danger"></i></a>
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