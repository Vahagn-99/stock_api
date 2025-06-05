<?php

namespace App\Base\Auth;

use App\Models\AccessToken;
use Carbon\Carbon;
use Crypt;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasCustomToken
{
    /**
     * Содание нового токена
     *
     * @param string|null $name
     * @param Carbon|null $expires_at
     * @return string
     */
    public function newToken(?string $name = null, ?Carbon $expires_at = null) : string
    {
        $name = $name ?? 'api';

        $this->tokens()->where('name', $name)->delete();

        $plain_token = bin2hex(random_bytes(32));

        $hashed_token = hash('sha256', $plain_token);

        $token = new AccessToken();

        $token->user_id = $this->id;
        $token->name = $name;
        $token->token = $hashed_token;
        $token->expires_at = $expires_at;

        $token->save();

        return $plain_token;
    }

    /**
     * Обновление токена
     *
     * @param string|null $name
     * @return string|null
     */
    public function refreshToken(?string $name = null) : ?string
    {
        $token = $this->token;

        if (empty($token)) {
            return $this->newToken($name ??'api');
        }

        $plain_token = bin2hex(random_bytes(32));

        $hashed_token = hash('sha256', $plain_token);

        $token->token = $hashed_token;

        if ($token->expires_at?->isPast()) {
            $token->expires_at = Carbon::now()->addDays(30);
        }

        $token->save();

        return $plain_token;
    }

    /**
     * Инвалидация токена
     *
     * @return bool|null
     */
    public function invalidateActiveToken() : ?bool
    {
        return $this->token()->delete();
    }

    /**
     * Отношение к последнему токену
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function token() : HasOne
    {
        return $this->hasOne(AccessToken::class, 'user_id', 'id')->latest();
    }

    /**
     * Отношение к токенам
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens() : HasMany
    {
        return $this->hasMany(AccessToken::class, 'user_id', 'id')->latest();
    }
}