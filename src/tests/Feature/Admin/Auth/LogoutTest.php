<?php

namespace Tests\Feature\Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_logout()
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $oldToken = session()->token();

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.loginForm'));

        $this->assertGuest();
        $this->assertNotEquals($oldToken, session()->token());
    }

    public function test_logout_invalidates_session()
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $oldSessionId = session()->getId();

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.loginForm'));

        $this->assertNotEquals($oldSessionId, session()->getId());
    }

    public function test_user_cannot_access_protected_route_after_logout()
    {
        $user = $this->getUser();
        $this->actingAs($user);

        $this->post(route('admin.logout'));

        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.loginForm'));
    }
}
