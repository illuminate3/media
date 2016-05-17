<?php

namespace App\Modules\Media\Library\Image;


interface ImageFactoryInterface
{

	/**
	 * Return a new Manipulation class
	 * @param  string $manipulation
	 * @return App\Modules\Media\Library\Image\ImageHandlerInterface
	 */
	public function make($manipulation);


}
