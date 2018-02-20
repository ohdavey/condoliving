@extends('layouts.app')

@section('content')

    <property :property="{{ $property }}" :community="{{ $property->community }}" inline-template v-cloak>
        <div class="container property">
            @can ('update', $property)
                <div class="clearfix">
                    <ul class="nav admin-nav pull-left">
                        <li><a @click="editing = true">Edit</a></li>
                        <li><a href="#">Delete</a></li>
                        <li><a href="{{ $property->path() }}/property/create">Add Property</a></li>
                    </ul>
                    <div v-if="editing" class="pull-right">
                        <button class="btn btn-xs btn-primary" @click="update">Update</button>
                        <button class="btn btn-xs btn-danger" @click="reset">Cancel</button>
                    </div>
                </div>
            @endcan
            <h2 class="page-header" v-if="editing">
                <input class="form-control" name="address" v-model="address">
            </h2>
            <h2 v-else v-text="address" class="page-header"></h2>

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
                    <p v-if="editing">
                        <textarea class="form-control" name="body" v-model="body"></textarea>
                    </p>
                    <p v-else v-text="body"></p>
                </div>

                <div class="col-md-5">
                    <p>
                        Created: <strong v-text="created_ago"></strong><br/>
                        Updated: <strong v-text="updated_ago"></strong>
                    </p>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-bed"></i>
                                    </span>
                                    <input class="form-control" name="beds" v-model="beds">
                                    <span class="input-group-addon">
                                        Bedrooms.
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-bed"></i>
                                <span v-text="beds"></span> Bedrooms
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-bath"></i>
                                    </span>
                                    <input class="form-control" name="baths" v-model="baths">
                                    <span class="input-group-addon">
                                        Baths
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-bath"></i>
                                <span v-text="baths"></span> Baths
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-minus-square-o"></i>
                                    </span>
                                    <input class="form-control" name="sqft" v-model="sqft">
                                    <span class="input-group-addon">
                                        Sqft.
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-minus-square-o"></i>
                                 <span v-text="sqft"></span> Sqft.
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-car"></i>
                                    </span>
                                    <input class="form-control" name="parking" v-model="parking">
                                    <span class="input-group-addon">
                                        Car Garage
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-car"></i>
                                <span v-text="parking"></span> Car Garage
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-calendar-o"></i>
                                    </span>
                                    <input class="form-control" name="year_built" v-model="year_built">
                                    <span class="input-group-addon">
                                        Built
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-calendar-o"></i>
                                <span v-text="year_built"></span> Built
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" v-if="editing">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-1x fa-home"></i>
                                    </span>
                                    <select name="type" id="type" class="form-control" v-model="type" required>
                                        <option value="">Choose country</option>
                                        <option value="Condo">Condo</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="House">House</option>
                                        <option value="Apartment">Apartment</option>
                                        <option value="Manufactured">Manufactured</option>
                                    </select>
                                    <span class="input-group-addon">
                                        Type
                                    </span>
                                </div>
                            </div>
                            <span v-else>
                                <i class="fa fa-fw fa-1x fa-home"></i>
                                <span v-text="type"></span>
                            </span>
                        </div>
                    </div>

                        <div class="form-group" v-if="editing">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                </span>
                                <input class="form-control" name="price" v-model="price">
                                <span class="input-group-addon">/month</span>
                            </div>
                        </div>
                        <div v-else>
                            <h3 style="margin-top: 0px;">
                                <br/><strong><i class="fa fa-dollar"></i><span v-text="price"></span></strong>
                                <small>/month</small>
                            </h3>
                        </div>

                    <p>
                        <i class="fa fa-map-marker"></i>
                        <span v-text="address"></span><br>
                        <span v-text="city"></span>
                        , <span v-text="state"></span> <span v-text="postcode"></span>
                    </p>
                    <p>&nbsp;</p>
                    <a href="#" class="btn btn-lg btn-default">Contact Owner</a>

                </div>
            </div>
        </div>
    </property>
@endsection