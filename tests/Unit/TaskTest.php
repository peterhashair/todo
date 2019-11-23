<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testLoginTest()
    {

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');
    }


}
