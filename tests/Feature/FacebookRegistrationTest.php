<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacebookRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_email_can_be_entered_for_contact()
    {
        $response = $this->post('/facebookregistration', [
            'email' => 'abc@def.com'
        ]);

        $this->assertDatabaseCount('facebook_registrations', 1);
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post('/facebookregistration', [
            'email' => ''
        ]);

        $this->assertDatabaseCount('facebook_registrations', 0);

    }

}
