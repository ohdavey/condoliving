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
                        <a href="{{ $community->path() }}" class="card-img">
                            <img src="http://placehold.it/700x400" alt="">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ $community->path() }}">{{ $community->name }}</a>
                            </h4>
                        </div>
                        <div class="card-footer">
                            <i class="fa fa-map-marker text-danger"></i> {{ $community->city }}, {{ $community->state }}
                            <small class="text-muted pull-right">★ ★ ★ ★ ☆</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection