<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    private User $user;

    protected function setUp():void
    {
        parent::setUp();

        $this->user = User::factory()->create(['password' => 'password']);
    }

    protected function getUser()
    {
        return $this->user;
    }

    protected function getUserId()
    {
        return $this->user->id;
    }
}
