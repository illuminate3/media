<?php

namespace App\Modules\Media\Library\Support\Traits;

trait MediaRelation
{

	/**
	 * Make the Many To Many Morph To Relation
	 * @return object
	 */
	public function files()
	{
		return $this->morphToMany('App\Modules\Media\Http\Models\File', 'imageable', 'media__imageables')->withPivot('zone', 'id')->withTimestamps()->orderBy('order');
	}


}
