<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Scraping extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'selector',
        'property',
        'output',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
