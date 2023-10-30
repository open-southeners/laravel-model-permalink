<?php

return [

    'model' => \OpenSoutheners\LaravelModelPermalink\ModelPermalink::class,

    'path' => 'permalinks',

    'middleware' => ['web', 'auth'],

];
