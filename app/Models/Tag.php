<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * Check tag creator.
     */
    public function isTagCreator(): bool
    {
        if($this->user_id == auth()->user()->id) {
            return true;
        }

        return false;
    }

    /**
     * Get tag creator.
     */
    public function getTagCreator()
    {
       return User::find($this->user_id);
    }

    /**
     * Get all the tasks related to this tag.
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_tag');
    }
}