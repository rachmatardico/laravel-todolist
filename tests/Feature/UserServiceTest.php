<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("matt", "rahasia"));
    }

    public function testLogiUserNotFound()
    {
        self::assertFalse($this->userService->login("rachmat", "rachmat"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("matt", "salah"));
    }
}
