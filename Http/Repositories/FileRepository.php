<?php

namespace App\Modules\Media\Http\Repositories;

use App\Modules\Core\Repositories\Base\BaseRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;


interface FileRepository extends BaseRepository
{

	/**
	 * Create a file row from the given file
	 * @param  UploadedFile $file
	 * @return mixed
	 */
	public function createFromFile(UploadedFile $file);

	/**
	 * Find a file for the entity by zone
	 * @param string $zone
	 * @param object $entity
	 * @return object
	 */
	public function findFileByZoneForEntity($zone, $entity);

	/**
	 * Find multiple files for the given zone and entity
	 * @param zone $zone
	 * @param object $entity
	 * @return object
	 */
	public function findMultipleFilesByZoneForEntity($zone, $entity);


}
