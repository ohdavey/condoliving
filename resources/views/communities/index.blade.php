@extends('layouts.app')

@section('content')
    <div class="container communities">
        <h2 class="page-header">
            Communities
        </h2>
        <div class="row">
            @foreach ($communities as $community)
                <div class="col-md-4">
                    <div class="card thumbnail">
                        <a href="{{ $community->path() }}" class="card-preview">
                            <img src="https://picsum.photos/700/400/?random" alt="">
                            <h4 class="card-title">
                                {{ $community->name }}
                            </h4>
                            <span class="property-count label label-warning">{{ count($community->properties) }}</span>
                        </a>
                        <div class="card-body">
                            <i class="fa fa-map-marker text-danger"></i> {{ $community->city }}, {{ $community->state }}
                            <small class="text-muted pull-right">★ ★ ★ ★ ☆</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection