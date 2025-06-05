<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    /** @var string */
    const TABLE = 'organizations';

    /** @var string */
    protected $table = self::TABLE;

    /**
     * Отношение к телефонам
     *
     * @return HasMany<\App\Models\OrganizationPhone>*
    */
    public function phones(): HasMany
    {
        return $this->hasMany(OrganizationPhone::class, 'organization_id', 'id');
    }

    /**
     * Отношение к активностям
     *
     * @return BelongsToMany<\App\Models\Activity>
    */
    public function activities() : BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_organization', 'organization_id', 'activity_id', 'id', 'id');
    }

    /**
     * Отношение к зданию
     *
     * @return BelongsTo<\App\Models\Building>
    */
    public function building() : BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id', 'id');
    }
}
