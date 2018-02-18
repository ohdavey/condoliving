@extends('layouts.app')

@section ('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <div class="container communities">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Community</div>
                    <fieldset class="panel-body">
                        <form method="POST" action="/community/create" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <fieldset class="row">
                                <legend class="col-sm-12">Location</legend>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    </div>
                                </div>
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
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="postcode">Post Code</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ old('postcode') }}" required>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="country">Country:</label>
                                        <select name="country" id="country" class="form-control" required>
                                            <option value="">Choose country</option>
                                            <option value="ES">Spain</option>
                                            <option value="FR">France</option>
                                            <option value="US">United States</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="btn btn-default">
                                            <i class="fa fa-file-image-o"></i> Upload Images...<input type="file" name="images[]" multiple="multiple" hidden>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Post</button>
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