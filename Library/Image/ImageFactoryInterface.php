<?php

namespace App\Modules\Media\Library\Image;

interface ImageFactoryInterface
{
    /**
     * Return a new Manipulation class
     * @param  string                                     $manipulation
     * @return \Modules\Media\Image\ImageHandlerInterface
     */
    public function make($manipulation);
}
