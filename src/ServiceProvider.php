<?php

namespace Skynettechnologies\AllInOneAccessibility;

use Statamic\Facades\CP;
use Statamic\Providers\AddonServiceProvider;
use Skynettechnologies\AllInOneAccessibility\Tags\Layout;
use Skynettechnologies\AllInOneAccessibility\Commands\CopyAssets;
use Skynettechnologies\AllInOneAccessibility\Tags\AllInOneAccessibility;
use Statamic\Statamic;
use Statamic\Facades\CP\Nav;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Permission;

class ServiceProvider extends AddonServiceProvider
{
	public function boot()
	{
		parent::boot();

		Statamic::booted(function () {
			$this
				->bootNavigation();
			$this->loadViewsFrom(__DIR__ . '/../resources/views', 'skynettechnologies/statamic-all-in-one-accessibility');
		
		    // Adding CSS and JS files
            $this->addAssets();
		});
		

		Statamic::afterInstalled(function ($command) {
			// Publish default settings, to make the first time experience easier
			$command->call('vendor:publish', ['--tag' => 'skynettechnologies/statamic-all-in-one-accessibility-settings']);
		});
	}

	protected function bootNavigation(): ServiceProvider
	{
		Nav::extend(function ($nav) {
			$cookieIconData = File::get(__DIR__ . '/../resources/public/images/logo.svg');

			$nav
				->create('All in One Accessibility®')
				->can('skynettechnologies/statamic-all-in-one-accessibility.all_in_one_accessibility_general')
				->route('skynettechnologies/statamic-all-in-one-accessibility.settings')
				->section('Tools')
				->icon($cookieIconData ?? 'alert');
		});

		return $this;
	}
	
	
    protected function addAssets()
    {
        Statamic::style('allinoneaccessibility', asset('css/allinoneaccessibility.css'));
        Statamic::style('bootstrap', asset('css/bootstrap.min.css'));
        Statamic::style('style', asset('css/style.css'));

        // Correct asset paths for JS
        Statamic::script('allinoneaccessibility-js', asset('js/allinoneaccessibility.js'));
    }

	protected function bootPublishables(): ServiceProvider
	{
		parent::bootPublishables();
		$this->publishes([
            __DIR__ . '/../resources/public/css' => public_path('css'),
            __DIR__ . '/../resources/public/js' => public_path('js'),
            __DIR__ . '/../resources/public/images' => public_path('images'),
        ], 'skynettechnologies/statamic-all-in-one-accessibility-assets');

		return $this;
	}

	public function bootAddon()
	{
	}

	protected $routes = [
		'cp' => __DIR__ . '/../routes/cp.php',
	];

	protected $tags = [
		AllInOneAccessibility::class,
	];

	protected $commands = [
		CopyAssets::class,
	];


	protected $modifiers = [
		//
	];

	protected $fieldtypes = [
		//
	];

	protected $widgets = [
		//
	];
}
