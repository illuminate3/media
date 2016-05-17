<?php

namespace App\Modules\Media\Library\Image;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Modules\Media\Library\Image\Intervention\InterventionFactory;


class ImageServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'App\Modules\Media\Library\Image\ImageFactoryInterface',
			'App\Modules\Media\Library\Image\Intervention\InterventionFactory'
		);

		$this->app['imagy'] = $this->app->share(function ($app) {
			$factory = new InterventionFactory();
			$thumbnailManager = new ThumbnailsManager($app['config'], $app['modules']);

			return new Imagy($factory, $thumbnailManager, $app['config']);
		});

		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('Imagy', 'App\Modules\Media\Library\Image\Facade\Imagy');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['imagy'];
	}


}
