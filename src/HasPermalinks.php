<?php

namespace OpenSoutheners\LaravelModelPermalink;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasPermalinks
{
    /**
     * Get model generated permalinks.
     */
    public function permalinks(): MorphMany
    {
        return $this->morphMany(config('model-permalink.model'), 'model')->latest();
    }
}
