<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToDoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function toggleComplete(): void
    {
        $this->completed_at = $this->completed_at ? null : now();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
