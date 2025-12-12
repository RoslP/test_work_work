<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Comment extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'article_id',
        'user_id',
        'content',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function toSearchableArray(): array
    {
        // All model attributes are made searchable
        $array = $this->toArray();

        $array['user'] = [
            'id' => $this->user->id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'is_admin' => $this->user->is_admin,
        ];

        return $array;
    }
}
