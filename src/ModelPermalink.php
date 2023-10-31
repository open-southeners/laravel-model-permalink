<?php

namespace OpenSoutheners\LaravelModelPermalink;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $uuid
 * @property \OpenSoutheners\LaravelModelPermalink\PermalinkAccess $model
 * @property string $model_id
 * @property string $model_type
 */
class ModelPermalink extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['uuid', 'model_id', 'model_type'];

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public function uniqueIds()
    {
        return ['uuid'];
    }

    /**
     * Model that is being permalinked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo<\Illuminate\Database\Eloquent\Model, self>
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get permalink route URL from related model.
     */
    public function getModelPermalink(): string
    {
        return route('model_permalinks.show', $this->uuid);
    }
}
