<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'quote'
    ];

    public function Author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
