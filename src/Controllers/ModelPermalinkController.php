<?php

namespace OpenSoutheners\LaravelModelPermalink\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class ModelPermalinkController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(string $permalink)
    {
        /** @var class-string<\OpenSoutheners\LaravelModelPermalink\ModelPermalink> $model */
        $model = config('model-permalink.model');

        /** @var \OpenSoutheners\LaravelModelPermalink\ModelPermalink $permalink */
        $permalink = $model::with('model')
            ->where('uuid', $permalink)
            ->firstOrFail();

        $this->authorize('viewModelPermalink', $permalink->model);

        return Response::redirectTo($permalink->model->getPermalink());
    }
}
