<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTrackingScreenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ticket_tracking_screen_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200); 
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ticket_tracking_screen_is_rendered()
    {
        $view = $this->view('')
    }
}
