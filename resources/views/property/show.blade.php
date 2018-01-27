@extends('layouts.app')

@section('content')
    <div class="container property">
        <h2 class="page-header">
            {{ $property->address }} <span class="pull-right label label-info">{{ $property->statusText() }}</span>
        </h2>
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-sm-12">
                        <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                    </div>
                    <div class="col-sm-12">
                        <div class="clearfix">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="https://picsum.photos/700/400/?random" alt="">
                            </div>
                        </div>
                    </div>


                </div>
                <h3>
                    Description
                </h3>
                <p>{{ $property->body }}</p>
            </div>

            <div class="col-md-5">
                <p>
                    Created: <strong>{{ $property->created_at->diffForHumans() }}</strong><br/>
                    Updated: <strong>{{ $property->updated_at->diffForHumans() }}</strong>
                </p>

                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-bed"></i> {{ $property->beds }} Bedroom
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-bath"></i> {{ $property->baths }} Bathroom
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-minus-square-o"></i> {{ $property->sqft}} Sqft.
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-car"></i> {{ $property->parking }} Car Garage
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-calendar-o"></i> Built {{ $property->year_built}}
                    </div>
                    <div class="col-sm-6">
                        <i class="fa fa-fw fa-1x fa-home"></i> {{ $property->type}}
                    </div>
                </div>

                <h3><small>Price</small><br/><strong>${{ $property->price }}</strong><small>/month</small></h3>

                <p>
                <i class="fa fa-map-marker"></i>
                    {{ $property->address }}<br>
                    {{ $property->community->city }}, {{ $property->community->state }} {{ $property->community->postcode }}
                </p>
                <p>&nbsp;</p>
                <a href="#" class="btn btn-lg btn-default">Contact Owner</a>
            </div>
        </div>
    </div>
@endsection