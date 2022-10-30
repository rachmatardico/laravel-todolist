<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user"      => "matt",
            "todolist"  => [
                [
                    "id"    => "1",
                    "todo"  => "Test"
                ]   
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Test");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user"  => "matt"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required!");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user"  => "matt"
        ])->post('/todolist', [
            "todo"  => "Test"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user"      => "matt",
            "todolist"  => [
                [
                    "id"    => "1",
                    "todo"  => "Test"
                ]   
            ]
        ])->post("todolist/1/delete")
            ->assertRedirect("/todolist");
    }
}
