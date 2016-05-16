<?php

namespace App\Modules\Media\Providers;

//use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Menu;
use Theme;
use View;


class MediaServiceProvider extends ServiceProvider
{

	/**
	 * Register the Media module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.

		$this->registerNamespaces();
		$this->registerProviders();

	}


	/**
	 * Register the Media module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		View::addNamespace('Media', __DIR__.'/../Resources/Views/');
	}


	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../Config/media.php' => config_path('media.php'),
			__DIR__ . '/../Resources/Assets/Images' => base_path('public/assets/images/'),
			__DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/Media/',
			__DIR__ . '/../Resources/Assets/Views/Widgets' => public_path('themes/') . Theme::getActive() . '/views/widgets/',
		]);

		$this->publishes([
			__DIR__.'/../Config/Media.php' => config_path('Media.php'),
		], 'configs');

		$this->publishes([
			__DIR__ . '/../Resources/Assets/Images' => base_path('public/assets/images/'),
		], 'images');

		$this->publishes([
			__DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/Media/',
//			__DIR__ . '/../Resources/Assets/Views/Widgets' => public_path('themes/') . Theme::getActive() . '/views/widgets/',
		], 'views');

/*
		AliasLoader::getInstance()->alias(
			'Menus',
			'TypiCMS\Modules\Menus\Facades\Facade'
		);
*/

		$app = $this->app;

		$app->register('Codesleeve\LaravelStapler\Providers\L5ServiceProvider');
		$app->register('Cviebrock\EloquentSluggable\SluggableServiceProvider');

	}


	/**
	* add Prvoiders
	*
	* @return void
	*/
	private function registerProviders()
	{
		$app = $this->app;

		$app->register('App\Modules\Media\Providers\RouteServiceProvider');
//		$app->register('App\Modules\Media\Providers\WidgetServiceProvider');

	}

}