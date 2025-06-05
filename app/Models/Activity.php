<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    /** @use HasFactory<\Database\Factories\ActivityFactory> */
    use HasFactory;

    /** @var string */
    const TABLE = 'activities';

    /** @var string */
    protected $table = self::TABLE;

    /**
     * Отношение к родительской активности
     *
     * @return BelongsTo
    */
    public function parent() : BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id', 'id');
    }

    /**
     * Отношение к первой активности
     *
     * @return BelongsTo<self, self>
     */
    public function original(): BelongsTo
    {
        if ($this->parent_id === null) {
            return $this->belongsTo(self::class, 'id');
        }

        return $this->belongsTo(self::class, 'parent_id')
            ->withDefault()
            ->original ?: $this->parent();
    }

    /**
     * Отношение к дочерним активностям
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function children() : HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id', 'id');
    }

    /**
     * Отношение к организациям
     *
     * @return BelongsToMany<\App\Models\Activity>
     */
    public function organizations() : BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'activity_organization', 'activity_id', 'organization_id', 'id', 'id');
    }
}
