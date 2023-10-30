<?php

namespace OpenSoutheners\LaravelModelPermalink;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface PermalinkAccess
{
    /**
     * Get permanent links morph relationship.
     */
    public function permalinks(): MorphMany;

    /**
     * Get permanent link for this model instance.
     */
    public function getPermalink(): string;
}
