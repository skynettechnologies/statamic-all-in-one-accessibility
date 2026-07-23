<?php

namespace Skynettechnologies\AllInOneAccessibility;

use Statamic\Facades\CP;
use Statamic\Providers\AddonServiceProvider;
use Skynettechnologies\AllInOneAccessibility\Commands\CopyAssets;
use Skynettechnologies\AllInOneAccessibility\Tags\AllInOneAccessibility;
use Statamic\Statamic;
use Statamic\Facades\CP\Nav;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Permission;

class ServiceProvider extends AddonServiceProvider
{
    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    protected $tags = [
        AllInOneAccessibility::class,
    ];

    protected $commands = [
        CopyAssets::class,
    ];


    // Add CP assets here (Statamic 6 style)
    protected $cp = [
        'css' => [
            '/assets/allinoneaccessibility/css/allinoneaccessibility.css',
            '/assets/allinoneaccessibility/css/style.css',
        ],
        'js' => [
            '/assets/allinoneaccessibility/js/allinoneaccessibility.js',
        ],
    ];

    protected $permissions = [
        'all_in_one_accessibility_general' => 'All In One Accessibility Settings',
    ];

	public function boot()
	{
		parent::boot();

        // Register permission for the addon
        $this->registerPermissions();

        // Run after Statamic fully boots
        Statamic::booted(function () {
            $this->bootNavigation();
            $this->loadViewsFrom(__DIR__ . '/../resources/views', 'skynettechnologies/statamic-all-in-one-accessibility');
        });

        // After installation, publish default settings
		Statamic::afterInstalled(function ($command) {
			// Publish default settings, to make the first time experience easier
			$command->call('vendor:publish', [
			    '--tag' => 'skynettechnologies/statamic-all-in-one-accessibility-settings']);
		});
	}

    /**
     * Register the navigation item in the Control Panel Tools sidebar
     */
	protected function bootNavigation(): void
	{
		Nav::extend(function ($nav) {
            $svgPath = __DIR__ . '/../resources/public/images/logo.svg';
            $iconData = File::exists($svgPath) ? File::get($svgPath) : 'alert';
            $nav->create('All in One Accessibility®')
                ->can('skynettechnologies/statamic-all-in-one-accessibility.access')
                ->route('skynettechnologies.statamic_all_in_one_accessibility.settings')
                ->section('Tools')
                ->icon($iconData);
		});
	}

    /**
     * Register addon permission
     */
    protected function registerPermissions(): void
    {
        // Statamic 6 only needs the permission handle
        Permission::register('skynettechnologies/statamic-all-in-one-accessibility.access');
    }

	protected function bootPublishables(): ServiceProvider
	{
		parent::bootPublishables();
		$this->publishes([
            __DIR__ . '/../resources/public/css' => public_path('assets/allinoneaccessibility/css'),
            __DIR__ . '/../resources/public/js' => public_path('assets/allinoneaccessibility/js'),
            __DIR__ . '/../resources/public/images' => public_path('assets/allinoneaccessibility/images'),
        ], 'skynettechnologies/statamic-all-in-one-accessibility-assets');

		return $this;
	}

}
