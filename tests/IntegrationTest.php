<?php

namespace OpenSoutheners\LaravelModelPermalink\Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Route;
use OpenSoutheners\LaravelModelPermalink\ModelPermalink;
use OpenSoutheners\LaravelModelPermalink\Tests\Fixtures\Post;

class IntegrationTest extends TestCase
{
    public function testHasPermalinksGetsManyMorphRelations()
    {
        $post = new Post();

        $post->forceFill([
            'title' => 'Hello world',
            'content' => 'Hello world',
        ])->save();

        $modelPermalink = new ModelPermalink();

        $modelPermalink->model()->associate($post);

        $modelPermalink->save();

        $modelPermalink = new ModelPermalink();

        $modelPermalink->model()->associate($post);

        $modelPermalink->save();

        $this->assertCount(2, $post->permalinks);
    }

    public function testAnyUserCanAccessAnyModelPermalinkByDefault()
    {
        $this->withoutExceptionHandling();

        $user = new User();

        $user->forceFill([
            'name' => 'Test User',
            'email' => 'test@hello.org',
            'password' => '',
        ])->save();

        $this->actingAs($user);

        Route::get('posts/{id}', function ($id) {
            $post = Post::findOrFail($id);

            return response($post->title);
        })->name('posts.show');

        $post = new Post();

        $post->forceFill([
            'title' => 'Hello world',
            'content' => 'Hello world',
        ])->save();

        $modelPermalink = new ModelPermalink();

        $modelPermalink->model()->associate($post);

        $modelPermalink->save();

        $response = $this->get(route('model_permalinks.show', $modelPermalink));

        $response->assertRedirectToRoute('posts.show', $post);

        $redirectedResponse = $this->followRedirects($response->baseResponse);

        $redirectedResponse->assertContent('Hello world');
    }
}
