<?php

namespace OpenSoutheners\LaravelModelPermalink;

class GeneratePermalink
{
    /**
     * Generate permalink for specified model instance.
     *
     * @return \OpenSoutheners\LaravelModelPermalink\ModelPermalink
     */
    public static function for(PermalinkAccess $model, bool $unique = true)
    {
        if ($unique) {
            return $model->permalinks()->firstOrCreate();
        }

        return $model->permalinks()->create();
    }
}
