@extends('layouts.app')

@section('content')
    <div class="container communities">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">

                        <div class="wrapper row">
                            <div class="preview col-md-5">

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

                            </div>
                            <div class="details col-md-6">
                                <h2 class="product-title">{{ $community->name }}</h2>
                                <div class="rating">
                                    <div class="stars">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                </div>
                                <p class="count"> <span class="label label-info">{{ count($community->properties) }}</span> Properties Available</p>
                                <p class="description">{{ $community->description }}</p>
                                <h4 class="price">Starting At: <span>${{ $community->properties[0]->price }}</span></h4>
                                <p class="address">
                                    <i class="fa fa-map-marker text-danger"></i> {{ $community->address }} <br>
                                    {{ $community->city }}, {{ $community->state }} {{ $community->postcode }}
                                </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    @foreach ($community->properties as $property)
                        <div class="col-md-4">
                            <div class="card thumbnail">
                                <a href="{{ $property->path() }}" class="card-preview">
                                    <img src="https://picsum.photos/700/400/?random" alt="">
                                    <h4 class="card-title">
                                        {{ $property->type }}
                                    </h4>
                                </a>
                                <div class="card-body">
                                    <i class="fa fa-map-marker text-danger"></i> {{ $property->address }}, {{ $property->unit }}
                                    <small class="text-muted pull-right">★ ★ ★ ★ ☆</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection