<?php

namespace App\Modules\Media\Http\Controllers;

//use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use App\Modules\Media\Library\Image\ThumbnailsManager;
use App\Modules\Media\Http\Repositories\FileRepository;


class MediaGridController extends FilexController
{
    /**
     * @var FileRepository
     */
    private $file;
    /**
     * @var ThumbnailsManager
     */
    private $thumbnailsManager;

    public function __construct(FileRepository $file, ThumbnailsManager $thumbnailsManager)
    {
        parent::__construct();

        $this->file = $file;
        $this->thumbnailsManager = $thumbnailsManager;
    }

    /**
     * A grid view for the upload button
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $files = $this->file->all();
        $thumbnails = $this->thumbnailsManager->all();

        return view('media::admin.grid.general', compact('files', 'thumbnails'));
    }

    /**
     * A grid view of uploaded files used for the wysiwyg editor
     * @return \Illuminate\View\View
     */
    public function ckIndex()
    {
        $files = $this->file->all();
        $thumbnails = $this->thumbnailsManager->all();

        return view('media::admin.grid.ckeditor', compact('files', 'thumbnails'));
    }
}
