<?php

namespace App\Modules\Media\Library\Image\Intervention\Manipulations;

use App\Modules\Media\Library\Image\ImageHandlerInterface;


class Pixelate implements ImageHandlerInterface
{

	private $defaults = [
		'size' => 0,
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

		return $image->pixelate($options['size']);
	}


}
