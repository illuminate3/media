<?php

namespace App\Modules\Media\Library\Image\Facade;

use Illuminate\Support\Facades\Facade;


class Imagy extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'imagy';
	}


}
