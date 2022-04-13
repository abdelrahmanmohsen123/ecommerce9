<?php
namespace App\services;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\UrlGenerator\DefaultUrlGenerator;

class CustomMediaPathGenerator extends DefaultUrlGenerator{
    public function getUrl(): string
    {
        return public_path("storage".DIRECTORY_SEPARATOR."{$this->media->id}".DIRECTORY_SEPARATOR."{$this->media->file_name}");
    }
}
