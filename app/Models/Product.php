<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'status',
    ];

    public function getImageUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('products');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->chaperone();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }



}
