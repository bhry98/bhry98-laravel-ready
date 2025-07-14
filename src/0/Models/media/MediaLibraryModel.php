<?php

namespace Bhry98\Bhry98LaravelReady\Models\media;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryModel extends Media
{
    const TABLE_NAME = 'media_library';
    protected $table = self::TABLE_NAME;
}
