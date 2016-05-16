<?php

namespace App\Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;


class FileTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['description', 'alt_attribute', 'keywords'];
    protected $table = 'media__file_translations';
}
