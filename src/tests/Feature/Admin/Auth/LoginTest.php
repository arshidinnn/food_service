<?php

namespace Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_sign_in(): void
    {
        $user = $this->getUser();

        $response = $this->post(route('admin.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertRedirectToRoute('admin.dashboard');

        $this->assertAuthenticatedAs($user);

        $this->assertEmpty($user->getRememberToken(), 'Remember token was set.');
    }

    public function test_sign_in_with_remember_token() {
        $user = $this->getUser();

        $response = $this->post(route('admin.login'), [
            'email' => $user->email,
            'password' => 'password',
            'remember' => 'true'
        ]);

        $response->assertRedirect();
        $response->assertRedirectToRoute('admin.dashboard');

        $this->assertAuthenticatedAs($user);

        $user->refresh();

        $this->assertNotEmpty($user->getRememberToken(), 'Remember token was not set.');
    }

    public function test_sign_in_with_invalid_data() {
        $user = $this->getUser();

        $response = $this->post(route('admin.login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);

        $this->assertGuest();
    }

    public function test_sign_in_with_nonexistent_user() {
        $response = $this->post(route('admin.login'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['email']);

        $this->assertGuest();
    }
}
