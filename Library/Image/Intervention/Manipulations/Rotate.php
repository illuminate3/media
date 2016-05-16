<?php

namespace App\Modules\Media\Library\Image\Intervention\Manipulations;

use App\Modules\Media\Library\Image\ImageHandlerInterface;


class Rotate implements ImageHandlerInterface
{
    private $defaults = [
        'angle' => 45,
        'bgcolor' => '#000000',
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

        return $image->rotate($options['angle'], $options['bgcolor']);
    }
}
