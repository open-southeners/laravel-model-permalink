<?php

namespace OpenSoutheners\LaravelModelPermalink\Events;

use Illuminate\Queue\SerializesModels;
use OpenSoutheners\LaravelModelPermalink\PermalinkAccess;

class PermalinkGotAccessed
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public PermalinkAccess $model)
    {
        //
    }
}
