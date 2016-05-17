<?php

namespace App\Modules\Media\Library\Image;

//use Illuminate\Contracts\Config\Repository;
use Config;


class ThumbnailsManager
{

	/**
	 * @var Module
	 */
	private $module;
	/**
	 * @var Repository
	 */
	private $config;

	/**
	 * @param Repository $config
	 */
// 	public function __construct(Repository $config)
// 	{
// 		$this->module = app('modules');
// 		$this->config = $config;
// 	}

	/**
	 * Return all thumbnails for all modules
	 * @return array
	 */
	public function all()
	{
		$thumbnails = [];
// 		foreach ($this->module->enabled() as $enabledModule) {
// 			$configuration = Config::get('thumbnails');
// 			if (!is_null($configuration)) {
// 				$thumbnails = array_merge($thumbnails, Thumbnail::makeMultiple($configuration));
// 			}
// 		}
		$thumbnails = Config::get('thumbnails');

		return $thumbnails;
	}

	/**
	 * Find the filters for the given thumbnail
	 * @param $thumbnail
	 * @return array
	 */
	public function find($thumbnail)
	{
		foreach ($this->all() as $thumb) {
			if ($thumb->name() == $thumbnail) {
				return $thumb->filters();
			}
		}

		return [];
	}


}
