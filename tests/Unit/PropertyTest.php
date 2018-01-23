<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_has_an_owner()
    {
        $property = factory('App\Property')->create();
        $this->assertInstanceOf('App\User', $property->owner);
    }
}
