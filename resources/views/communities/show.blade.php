@extends('layouts.app')

@section('content')
    <community :community="{{ $community }}" inline-template v-cloak>
        <div class="container communities">
            @can ('update', $community)
                <ul class="nav admin-nav">
                    <li><a @click="editing = true">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                    <li><a href="{{ $community->path() }}/property/create">Add Property</a></li>
                </ul>
            @endcan
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
                                    <h2 v-if="editing">
                                        <input class="form-control" name="name" v-model="name">
                                    </h2>
                                    <h2 v-else v-text="name" class="community-title"></h2>
                                    <div class="rating">
                                        <div class="stars">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </div>
                                    <p class="count">
                                        <span class="label label-info">{{ count($community->properties) }}</span>
                                        Properties Available</p>
                                    <div v-if="editing">
                                        <div class="form-group">
                                            <textarea rows="4" class="form-control" name="description" v-model="description"></textarea>
                                        </div>
                                    </div>
                                    <p class="description" v-else v-text="description"></p>
                                    <h4 class="price">Starting At:
                                        <span>${{$community->lowestPrice()}}</span></h4>
                                    <div v-if="editing" class="row">
                                        <div class="form-group col-sm-6">
                                            <input class="form-control" name="address" v-model="address">
                                        </div>
                                        <div class="form-group col-sm-5">
                                            <input class="form-control" name="city" v-model="city">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <input class="form-control" name="state" v-model="state">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <input class="form-control" name="postcode" v-model="postcode">
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <input class="form-control" name="country" v-model="country">
                                        </div>
                                    </div>
                                    <p class="address" v-else>
                                        <i class="fa fa-map-marker text-danger"></i>
                                        <span v-text="address"></span><br>
                                        <span v-text="city"></span>,
                                        <span v-text="state"></span>
                                        <span v-text="postcode"></span>
                                        <span v-text="country"></span>
                                    </p>
                                </div>
                            </div>


                        </div>
                        @can ('update', $community)
                            <div v-if="editing" class="panel-footer clearfix">
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-primary" @click="update">Update</button>
                                    <button class="btn btn-xs btn-danger" @click="reset">Cancel</button>
                                </div>
                            </div>
                        @endcan
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
                                        <i class="fa fa-map-marker text-danger"></i> {{ $property->address }}
                                        , {{ $property->unit }}
                                        <small class="text-muted pull-right">{{
                                    $property->price }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </community>
@endsection