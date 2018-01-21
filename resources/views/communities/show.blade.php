@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{ $community->name }}</h1>
                    </div>
                    <div class="panel-body">
                        {{ $community->description }}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>Properties</h2>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach ($community->properties as $property)
                                <div class="col-md-4">
                                    <div class="card thumbnail">
                                        <a href="{{ $property->path() }}" class="card-img">
                                            <img src="http://placehold.it/700x400" alt="">
                                        </a>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="{{ $property->path() }}">{{ $property->type }}</a>
                                            </h4>
                                        </div>
                                        <div class="card-footer">
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
        </div>
    </div>
@endsection