<?php
use App\Community;
// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Home > [Community]
Breadcrumbs::register('communities', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Communities', route('communities'));
});

Breadcrumbs::register('community.show', function ($breadcrumbs, $community) { // <-- The same Post model is injected here
    $breadcrumbs->parent('communities');
    $breadcrumbs->push($community->name, route('community', $community));
});
