<?php

namespace App\Modules\Media\Http\Controllers;

//use Modules\Core\Http\Controllers\Admin\AdminBaseController;

//use Illuminate\Contracts\Config\Repository;

use App\Modules\Media\Http\Models\File;
use App\Modules\Media\Http\Requests\UpdateMediaRequest;
use App\Modules\Media\Library\Image\Imagy;
use App\Modules\Media\Library\Image\ThumbnailsManager;
use App\Modules\Media\Http\Repositories\FileRepository;

use Config;
use Theme;

class MediaController extends FilexController
{


	/**
	 * @var FileRepository
	 */
	private $file;
	/**
	 * @var Imagy
	 */
	private $imagy;
	/**
	 * @var ThumbnailsManager
	 */
	private $thumbnailsManager;

	public function __construct(
			FileRepository $file,
			Imagy $imagy,
			ThumbnailsManager $thumbnailsManager
		)
	{
		parent::__construct();

		$this->file = $file;
		$this->imagy = $imagy;
		$this->thumbnailsManager = $thumbnailsManager;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$files = File::all();
//dd($files);

		$max_file_size = Config::get('media.max-file-size');
		$allowed_types = Config::get('media.allowed-types');
//dd($max_file_zie);

		return Theme::View('modules.media.index',
			compact(
				'files',
				'max_file_size',
				'allowed_types'
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('media.create');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  File     $file
	 * @return Response
	 */
	public function edit(File $file)
	{
		$thumbnails = $this->thumbnailsManager->all();

		return Theme::View('modules.media.edit',
			compact(
				'file',
				'thumbnails'
				));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  File               $file
	 * @param  UpdateMediaRequest $request
	 * @return Response
	 */
	public function update(File $file, UpdateMediaRequest $request)
	{
		$this->file->update($file, $request->all());

		flash(trans('media::messages.file updated'));

		return redirect()->route('admin.media.media.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  File     $file
	 * @internal param int $id
	 * @return Response
	 */
	public function destroy(File $file)
	{
		$this->imagy->deleteAllFor($file);
		$this->file->destroy($file);

		flash(trans('media::messages.file deleted'));

		return redirect()->route('admin.media.media.index');
	}


}
