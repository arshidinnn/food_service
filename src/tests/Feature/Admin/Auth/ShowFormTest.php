<?php

namespace Tests\Feature\Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowFormTest extends TestCase
{
    public function test_show_login_form() {
        $response = $this->get(route('admin.loginForm'));

        $response->assertOk();
    }

    public function test_redirect_to_form_page() {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.loginForm'));
    }

}
