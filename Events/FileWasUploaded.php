<?php

namespace App\Modules\Media\Events;

use App\Modules\Media\Http\Models\File;


class FileWasUploaded
{
    /**
     * @var File
     */
    public $file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }
}
