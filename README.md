Laravel Model Permalink [![required php version](https://img.shields.io/packagist/php-v/open-southeners/laravel-model-permalink)](https://www.php.net/supported-versions.php) [![codecov](https://codecov.io/gh/open-southeners/laravel-model-permalink/branch/main/graph/badge.svg?token=codecov_badge_token)](https://codecov.io/gh/open-southeners/laravel-model-permalink) [![Edit on VSCode online](https://img.shields.io/badge/vscode-edit%20online-blue?logo=visualstudiocode)](https://vscode.dev/github/open-southeners/laravel-model-permalink)
===

Add permalinks to your application's Eloquent models

## Getting started

```
composer require open-southeners/laravel-model-permalink
```

### Usage

First run the command to publish the config and **required migrations** files:

```bash
php artisan vendor:publish --provider="OpenSoutheners\\LaravelModelPermalink\\ServiceProvider"
```

Then run new migrations:

```bash
php artisan migrate
```

And add the `PermalinkAccess` interface, `HasPermalinks` trait and `getPermalink` method to the models you want to have permalinks:

```php
<?php

namespace App\Models;

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
        // Here is where you return the route that all posts permalinks should use...
        return route('posts.show', $this);
    }
}
```

Now to generate permalinks to this `Post` or any configured model you can call the following anywhere in your application's code:

```php
<?php

use App\Models\Post;
use OpenSoutheners\LaravelModelPermalink\GeneratePermalink;

$post = Post::find(1);

GeneratePermalink::for($post);

// or getting directly the route from returned ModelPermalink object

GeneratePermalink::for($post)->getModelPermalink();
```

## Partners

[![skore logo](https://github.com/open-southeners/partners/raw/main/logos/skore_logo.png)](https://getskore.com)

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
