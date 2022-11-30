<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered()
    {
        if (! Features::enabled(Features::resetPasswords())) {
            return $this->markTestSkipped('Password updates are not enabled.');
        }

        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }
}
