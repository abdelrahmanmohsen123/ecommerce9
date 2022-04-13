<?php

namespace App\Models;
use App\Traits\EscapeUniCodeJson;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Traits\HasTranslatableSlug;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model implements HasMedia
{
    use HasFactory,HasTranslations,InteractsWithMedia,HasTranslatableSlug,EscapeUniCodeJson;
    protected $table = 'models';
    protected $fillable =[
        'name','status','year','brand_id'
    ];
    public $translatable = ['name','slug'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    
    } 

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
