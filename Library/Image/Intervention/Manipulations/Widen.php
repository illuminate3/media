<?php

namespace App\Modules\Media\Library\Image\Intervention\Manipulations;

use App\Modules\Media\Library\Image\ImageHandlerInterface;


class Widen implements ImageHandlerInterface
{

	private $defaults = [
		'width' => 0,
	];

	/**
	 * Handle the image manipulation request
	 * @param  \Intervention\Image\Image $image
	 * @param  array                     $options
	 * @return \Intervention\Image\Image
	 */
	public function handle($image, $options)
	{
		$options = array_merge($this->defaults, $options);

		$callback = isset($options['callback']) ? $options['callback'] : null;

		return $image->widen($options['width'], $callback);
	}


}
