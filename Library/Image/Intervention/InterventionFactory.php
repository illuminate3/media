<?php

namespace App\Modules\Media\Library\Image\Intervention;

use App\Modules\Media\Library\Image\ImageFactoryInterface;


class InterventionFactory implements ImageFactoryInterface
{
    /**
     * @param  string                                     $manipulation
     * @return \Modules\Media\Image\ImageHandlerInterface
     */
    public function make($manipulation)
    {
        $class = 'Modules\\Media\\Image\\Intervention\\Manipulations\\' . ucfirst($manipulation);

        return new $class();
    }
}
