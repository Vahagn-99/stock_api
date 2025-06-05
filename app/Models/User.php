<?php

namespace App\Models;

use App\Base\Auth\HasCustomToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasCustomToken;

    /** @var string */
    const TABLE = 'users';

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
