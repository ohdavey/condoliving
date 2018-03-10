<?php
use App\Community;
use App\Property;
// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > Communities
Breadcrumbs::register('communities', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Communities', route('communities'));
});

// Home > Community > [Community]
Breadcrumbs::register('community.show', function ($breadcrumbs, $community) { // <-- The same Post model is injected here
    $breadcrumbs->parent('communities');
    $breadcrumbs->push($community->name, route('community.show', $community));
});

Breadcrumbs::register('property.show', function ($breadcrumbs, $community, $property) {
    $breadcrumbs->parent('community.show', $community);
    $breadcrumbs->push($property->address, route('property.show', ['community' => $community, 'property' => $property]));
});

Breadcrumbs::register('lease.create', function ($breadcrumbs, Community $community, Property $property) {
    $breadcrumbs->parent('property.show', $community, $property);
    $breadcrumbs->push('Create Lease');
});