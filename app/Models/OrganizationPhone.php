<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationPhone extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationPhoneFactory> */
    use HasFactory;

    /** @var string */
    const TABLE = 'organization_phones';

    /** @var string */
    protected $table = self::TABLE;

    /**
     * Отношение к организации
     * 
     * @return BelongsTo
    */
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}
