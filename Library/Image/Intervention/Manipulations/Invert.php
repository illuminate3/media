<?php

namespace App\Modules\Media\Library\Image\Intervention\Manipulations;

use App\Modules\Media\Library\Image\ImageHandlerInterface;


class Invert implements ImageHandlerInterface
{

	/**
	 * Handle the image manipulation request
	 * @param  \Intervention\Image\Image $image
	 * @param  array                     $options
	 * @return \Intervention\Image\Image
	 */
	public function handle($image, $options)
	{
		return $image->invert();
	}


}
