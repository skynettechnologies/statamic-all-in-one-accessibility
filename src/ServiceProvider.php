<?php

namespace Skynettechnologies\AllInOneAccessibility;

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
			$this->loadViewsFrom(__DIR__ . '/../resources/views', 'skynettechnologies/all-in-one-accessibility');
		});

		Statamic::afterInstalled(function ($command) {
			// Publish default settings, to make the first time experience easier
			$command->call('vendor:publish', ['--tag' => 'skynettechnologies/all-in-one-accessibility-settings']);
		});
	}

	protected function bootNavigation(): ServiceProvider
	{
		Nav::extend(function ($nav) {
			$cookieIconData = File::get(__DIR__ . '/../resources/images/logo.svg');

			$nav
				->create('All in One Accessibility™')
				->can('skynettechnologies/all-in-one-accessibility.all_in_one_accessibility_general')
				->route('skynettechnologies/all-in-one-accessibility.settings')
				->section('Tools')
				->icon($cookieIconData ?? 'alert');
		});

		return $this;
	}

	protected function bootPublishables(): ServiceProvider
	{
		parent::bootPublishables();

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
