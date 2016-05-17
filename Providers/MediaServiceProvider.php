<?php

namespace App\Modules\Media\Providers;

//use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\Modules\Media\Console\RefreshThumbnailCommand;
use App\Modules\Media\Http\Models\File;
use App\Modules\Media\Http\Repositories\Eloquent\EloquentFileRepository;
use App\Modules\Media\Http\Repositories\FileRepository;
use App\Modules\Media\Library\Validators\MaxFolderSizeValidator;

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
		$this->app->booted(function () {
			$this->registerBindings();
		});
		$this->registerCommands();

	}


	/**
	 * Register the Media module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		View::addNamespace('media', __DIR__.'/../Resources/Views/');
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

		$this->registerMaxFolderSizeValidator();

		$app = $this->app;

// 		$app->register('Codesleeve\LaravelStapler\Providers\L5ServiceProvider');
// 		$app->register('Cviebrock\EloquentSluggable\SluggableServiceProvider');

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
		$app->register('App\Modules\Media\Library\Image\ImageServiceProvider');

	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}



	private function registerBindings()
	{
		$this->app->bind(FileRepository::class, function ($app) {
			return new EloquentFileRepository(new File(), $app['filesystem.disk']);
		});
	}

	/**
	 * Register all commands for this module
	 */
	private function registerCommands()
	{
		$this->registerRefreshCommand();
	}

	/**
	 * Register the refresh thumbnails command
	 */
	private function registerRefreshCommand()
	{
		$this->app->bindShared('command.media.refresh', function ($app) {
			return new RefreshThumbnailCommand($app['App\Modules\Media\Http\Repositories\FileRepository']);
		});

		$this->commands('command.media.refresh');
	}

	private function registerMaxFolderSizeValidator()
	{
		Validator::extend('max_size', 'App\Modules\Media\Library\Validators\MaxFolderSizeValidator@validateMaxSize');
	}


}
