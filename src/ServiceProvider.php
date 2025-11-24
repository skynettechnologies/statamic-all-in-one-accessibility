<?php

namespace Skynettechnologies\AllInOneAccessibility;

use Statamic\Facades\CP;
use Statamic\Providers\AddonServiceProvider;
use Skynettechnologies\AllInOneAccessibility\Commands\CopyAssets;
use Skynettechnologies\AllInOneAccessibility\Tags\AllInOneAccessibility;
use Statamic\Statamic;
use Statamic\Facades\CP\Nav;
use Illuminate\Support\Facades\File;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    protected $tags = [
        AllInOneAccessibility::class,
    ];

    protected $commands = [
        CopyAssets::class,
    ];

    protected $modifiers = [];

    protected $fieldtypes = [];

    protected $widgets = [];

    public function boot()
    {
        parent::boot();

        Statamic::booted(function () {

            $this->bootNavigation();

            // Load CP CSS
            Statamic::style('aioa-allinone', '/vendor/statamic-all-in-one-accessibility/css/allinoneaccessibility.css');
            Statamic::style('aioa-bootstrap', '/vendor/statamic-all-in-one-accessibility/css/bootstrap.min.css');
            Statamic::style('aioa-style', '/vendor/statamic-all-in-one-accessibility/css/style.css');

            // Load CP JS
            Statamic::script('aioa-js', '/vendor/statamic-all-in-one-accessibility/js/allinoneaccessibility.js');

            // Load views
            $this->loadViewsFrom(__DIR__.'/../resources/views', 'skynettechnologies/statamic-all-in-one-accessibility');
        });

        // Publish assets
        $this->bootPublishables();
    }

    protected function bootNavigation(): ServiceProvider
    {
        $logoPath = __DIR__.'/../resources/public/images/logo.svg';

        $icon = File::exists($logoPath)
            ? File::get($logoPath)
            : 'alert';

        Nav::extend(function ($nav) use ($icon) {
            $nav
                ->create('All in One Accessibility®')
                ->section('Tools')
                ->route('skynettechnologies/statamic-all-in-one-accessibility.settings')
                ->can('skynettechnologies/statamic-all-in-one-accessibility.all_in_one_accessibility_general')
                ->icon($icon);
        });

        return $this;
    }

    protected function bootPublishables(): ServiceProvider
    {
        $this->publishes([
            __DIR__.'/../resources/public' => public_path('vendor/statamic-all-in-one-accessibility'),
        ], 'statamic-all-in-one-accessibility');

        return $this;
    }

    public function bootAddon()
    {
        // Optional addon boot logic
    }
}
