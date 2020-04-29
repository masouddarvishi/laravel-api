<?php

namespace Hooraweb\LaravelApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasSlug;

    protected $table = 'tags';

    protected $fillable = [
        'parent_id',
        'taxonomy_id',
        'label',
        'slug',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id', 'id');
    }

    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }


    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->usingLanguage('fa')
            ->generateSlugsFrom(
                (!request()->filled('slug') && $this->slug === null) ? 'label' : 'slug'
            )
            ->saveSlugsTo('slug');
    }


}
