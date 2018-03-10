@extends('layouts.app')

@section('content')
    <div class="container property">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Lease</div>
                    <fieldset class="panel-body">
                        <form method="POST" action="store" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <fieldset class="row">
                                <legend class="col-sm-12">Location</legend>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control" required>'Condo', 'Townhouse', 'House', 'Apartment', 'Manufactured'
                                            <option value="">Choose country</option>
                                            <option value="Condo">Condo</option>
                                            <option value="Townhouse">Townhouse</option>
                                            <option value="House">House</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Manufactured">Manufactured</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="beds">Beds</label>
                                        <input type="text" class="form-control" id="beds" name="beds" value="{{ old('beds') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="baths">Baths</label>
                                        <input type="text" class="form-control" id="baths" name="baths" value="{{ old('baths') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sqft">Square Feet</label>
                                        <input type="text" class="form-control" id="sqft" name="sqft" value="{{ old('sqft') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="parking">Parking</label>
                                        <input type="text" class="form-control" id="parking" name="parking" value="{{ old('parking') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="year_built">Year Built</label>
                                        <input type="text" class="form-control" id="year_built" name="year_built" value="{{ old('year_built') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="">&nbsp;</label>
                                        <label class="btn btn-default form-control">
                                            <i class="fa fa-file-image-o"></i> Upload Images...<input type="file" name="images[]" multiple="multiple" hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="body">Description:</label>
                                        <textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </fieldset>
                            {{--<community :tenants="" inline-template v-cloak></community>--}}
                            @if (count($errors))
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection