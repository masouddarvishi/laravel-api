<?php

namespace Hooraweb\LaravelApi\Models;

use Hooraweb\LaravelApi\Http\Resources\TaxonomyCollection;
use Hooraweb\LaravelApi\Http\Resources\TaxonomyResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Taxonomy extends Model
{
    use HasSlug, SoftDeletes;

    /** @var string $table */
    protected $table = 'taxonomies';

    /** @var array $fillable */
    protected $fillable = [
        'slug', 'label', 'group_name',
    ];

    public function tags()
    {
        return $this->hasMany(Tag::class, 'taxonomy_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('fa')
            ->generateSlugsFrom(
                (!request()->filled('slug') && $this->slug === null) ? 'group_name' : 'slug'
            )
            ->saveSlugsTo('slug');
    }

    public static function resource($data)
    {
        return new TaxonomyResource($data);
    }

    public static function collection($data)
    {
        return new TaxonomyCollection($data);
    }
}
