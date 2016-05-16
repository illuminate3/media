<?php namespace App\Modules\Media\Events;

use App\Modules\Media\Http\Models\File;

class FileWasLinked
{
    /**
     * @var File
     */
    public $file;
    /**
     * The entity that was linked to a file
     * @var object
     */
    public $entity;

    /**
     * @param File $file
     * @param object $entity
     */
    public function __construct(File $file, $entity)
    {
        $this->file = $file;
        $this->entity = $entity;
    }
}
