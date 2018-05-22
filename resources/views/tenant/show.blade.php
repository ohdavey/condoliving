@extends('layouts.app')

@section('content')
    <div class="container lease">
        @can ('update', $tenant)
            <div class="clearfix">
                <ul class="nav admin-nav pull-left">
                    <li><a @click="editing = true">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="#">Unlink</a></li>
                </ul>
                <div v-if="editing" class="pull-right">
                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                    <button class="btn btn-xs btn-danger" @click="reset">Cancel</button>
                </div>
            </div>
        @endcan

        <h2 class="page-header">
            Lease for {{ $tenant->first_name }} {{ $tenant->last_name }}
            <span class="pull-right label label-info">{{ $tenant->lease->statusText() }}</span>
        </h2>
        <div class="row">
            <div class="col-md-7">
                @if ($tenant)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-drivers-license-o"></i> Tenant Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="">
                                        <div class="thumbnail">
                                            <img class="img-responsive img-circle img-thumbnail"
                                                 src="https://picsum.photos/130/130/?person" alt="">
                                            <div class="caption text-center">
                                                <h3 class="panel-title">
                                                    <strong>{{ $tenant->first_name }} {{ $tenant->last_name }}</strong>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center"></div>
                                </div>
                                <div class="col-sm-7">
                                    <label>Name:</label> {{ $tenant->first_name }} {{ $tenant->last_name }}<br>
                                    <label>Identification:</label> {{ $tenant->personal_id }}<br>
                                    <label>Birth Date:</label> {{ date('d-m-Y', strtotime($tenant->dob)) }}<br>
                                    <label>Email:</label> {{ $tenant->email }}<br>
                                    <label>Phone:</label> {{ $tenant->phone }}<br>
                                    <label>Salary:</label> ${{ number_format($tenant->salary) }}<br>
                                    <label>Status:</label> {{ $tenant->property->statusText() }}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection