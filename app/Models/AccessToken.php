<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Encryption\Encrypter;

class AccessToken extends Model
{
    /** @var string */
    const TABLE = 'access_tokens';

    /** @var string */
    protected $table = self::TABLE;

    /**
     * Получение пользователя по токену
     *
     * @param string $token
     * @return ?User
     */
    public static function getUser(string $token) : ?User
    {
        $model = self::query()
            ->where('token', hash('sha256', $token))
            ->with('user')
            ->first();

        if (empty($model)) {
            return null;
        }

        return $model->user;
    }

    /**
     * Отношение к пользователю
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
