<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'ip_address',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
