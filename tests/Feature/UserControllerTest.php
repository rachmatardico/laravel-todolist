<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user"  => "matt",
            "password" => "rahasia"
        ])->assertRedirect("/")
            ->assertSessionHas("user", "matt");
    }

    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("User or Password is required!");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            "user"  => "matt",
            "password" => "salah"
        ])->assertSeeText("User or password not valid!");
    }

    public function testLogout()
    {
        $this->withSession([
            "user"  => "matt"
        ])->post('/logout')
            ->assertRedirect("/")
            ->assertSessionMissing("user");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user"  => "matt"
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginPageForUserAlreadyLogin()
    {
        $this->withSession([
            "user"  => "matt"
        ])->post('/login', [
            "user"  => "matt",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect("/login");
    }
}
