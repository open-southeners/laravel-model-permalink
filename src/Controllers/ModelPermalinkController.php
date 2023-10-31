<?php

namespace OpenSoutheners\LaravelModelPermalink\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use OpenSoutheners\LaravelModelPermalink\Events\PermalinkGotAccessed;

class ModelPermalinkController extends Controller
{
    use AuthorizesRequests;

    /**
     * Invoke controller action.
     */
    public function __invoke(string $permalink): RedirectResponse
    {
        /** @var class-string<\OpenSoutheners\LaravelModelPermalink\ModelPermalink> $model */
        $model = config('model-permalink.model');

        /** @var \OpenSoutheners\LaravelModelPermalink\ModelPermalink $permalink */
        $permalink = $model::with('model')
            ->where('uuid', $permalink)
            ->firstOrFail();

        $this->authorize('viewModelPermalink', $permalink->model);

        event(new PermalinkGotAccessed($permalink->model));

        return Response::redirectTo($permalink->model->getPermalink());
    }
}
