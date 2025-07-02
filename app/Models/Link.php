<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Link extends Model
{
    use HasFactory;

    public const SHORT_URL_LENGTH = 6;

    protected $fillable = [
        'url',
        'active'
    ];

    protected $guarded = [
        'user_id',
        'short_url'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->short_url = $model->generateShortUrl();
            $model->user_id = auth()->id();
        });
    }

    protected function generateShortUrl(): string
    {
        do {
            $shortUrl = Str::random(self::SHORT_URL_LENGTH);
        } while (self::where('short_url', $shortUrl)->exists());

        return $shortUrl;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function getVisitCountAttribute(): int
    {
        return $this->visits()->count();
    }
}
