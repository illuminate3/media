<?php

namespace App\Modules\Media\Http\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Media\Library\ValueObjects\MediaPath;

/**
 * Class File
 * @package Modules\Media\Entities
 * @property \Modules\Media\ValueObjects\MediaPath path
 */
class File extends Model
{

	use Translatable;
	/**
	 * All the different images types where thumbnails should be created
	 * @var array
	 */
	private $imageExtensions = ['jpg', 'png', 'jpeg', 'gif'];

	protected $table = 'media__files';
	public $translatedAttributes = ['description', 'alt_attribute', 'keywords'];
	protected $fillable = [
		'description',
		'alt_attribute',
		'keywords',
		'filename',
		'path',
		'extension',
		'mimetype',
		'width',
		'height',
		'filesize',
		'folder_id',
	];
	protected $appends = ['path_string'];

	public function getPathAttribute($value)
	{
		return new MediaPath($value);
	}

	public function getPathStringAttribute()
	{
		return (string) $this->path;
	}

	public function isImage()
	{
		return in_array(pathinfo($this->path, PATHINFO_EXTENSION), $this->imageExtensions);
	}


}
