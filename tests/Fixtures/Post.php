<?php

namespace OpenSoutheners\LaravelModelPermalink\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use OpenSoutheners\LaravelModelPermalink\HasPermalinks;
use OpenSoutheners\LaravelModelPermalink\PermalinkAccess;

class Post extends Model implements PermalinkAccess
{
    use HasPermalinks;

    /**
     * Get permanent link for this model instance.
     */
    public function getPermalink(): string
    {
        return route('posts.show', $this);
    }
}
