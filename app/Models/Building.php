<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    /** @use HasFactory<\Database\Factories\BuildingFactory> */
    use HasFactory;

    /** @var string */
    const TABLE = 'buildings';

    /** @var string */
    protected $table = self::TABLE;

    /**
     * Отношение к организациям
     *
     * @return HasMany
    */
    public function organizations() : HasMany
    {
        return $this->hasMany(Organization::class, 'building_id', 'id');
    }
}
