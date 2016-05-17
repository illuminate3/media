<?php

namespace App\Modules\Media\Library\UrlResolvers;

use Illuminate\Contracts\Filesystem\Factory;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AwsS3v3\AwsS3Adapter;


class BaseUrlResolver
{

	/**
	 * @var array
	 */
	private $resolvers = [];

	public function __construct()
	{
		$this->resolvers = [
			Local::class => new LocalUrlResolver(),
			AwsS3Adapter::class => new AwsS3UrlResolver(),
		];
	}

	/**
	 * Resolve the given path based on the set filesystem
	 * @param string $path
	 * @return string
	 */
	public function resolve($path)
	{
		$factory = app(Factory::class);
		$adapter = $factory->disk($this->getConfiguredFilesystem())->getDriver()->getAdapter();

		return $this->resolvers[get_class($adapter)]->resolve($adapter, $path);
	}

	/**
	 * @return string
	 */
	private function getConfiguredFilesystem()
	{
		return Config::get('media.filesystem');
	}


}
