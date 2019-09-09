<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\ArticleController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    public function testArticleCreation()
    {
        $user = User::first();

        $this->actingAs($user);

        $request = Request::create('/article', 'POST', [
            'title' => 'foo',
            'slug'  => 'foo',
            'text'  => 'bar',
        ]);

        $mock = Mockery::mock('App\Article');

        $mock->shouldReceive('create')->with([
            'title' => 'foo',
            'slug'  => 'foo',
            'text'  => 'bar',
            'author' => $user
        ])->once()->andReturn(true);

        $controller = new ArticleController(Auth::guard(), $mock);
        $response = $controller->store($request);

        $this->assertTrue($response);
    }
}
