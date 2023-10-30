<?php

namespace OpenSoutheners\LaravelModelPermalink\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use OpenSoutheners\LaravelModelPermalink\ModelPermalink;

class ModelPermalinkController extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Request $request, string $permalink)
    {
        $permalink = ModelPermalink::where('uuid', $permalink)->firstOrFail();

        /** @var \OpenSoutheners\LaravelModelPermalink\PermalinkAccess $permalinkModel */
        $permalinkModel = $permalink->model()->first();

        $this->authorize('viewModelPermalink', $permalinkModel);

        return Response::redirectTo($permalinkModel->getPermalink());
    }
}
