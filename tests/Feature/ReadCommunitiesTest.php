<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadCommunitiesTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

    public function setUp()
    {
        parent::setUp();

        $this->community = factory('App\Community')->create();
    }

    public function test_a_user_can_browse_communities()
    {
        $response = $this->get('/communities');

        $response->assertStatus(200);
    }

    public function test_a_user_can_see_a_single_community()
    {
        $response = $this->get('/communities/'. $this->community->id);
        $response->assertSee($this->community->name);
    }

    public function test_a_user_can_see_properties_associated_with_a_community()
    {
        $property = factory('App\Property')->create(['community_id' => $this->community->id]);

        $this->get('/communities/' . $this->community->id)->assertSee($property->address);
    }
}
