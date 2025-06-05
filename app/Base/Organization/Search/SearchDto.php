<?php

declare(strict_types=1);


namespace App\Base\Organization\Search;

use Spatie\LaravelData\Data;

class SearchDto extends Data
{
    /**
     * @param string|null $text
     * @param \App\Base\Organization\Search\CoordinatesDto|null $coordinates
     * @param \App\Base\Organization\Search\BuildingDto|null $building
     * @param \App\Base\Organization\Search\ActivityDto|null $activity
     */
    public function __construct(
        public readonly ?string $text = null,
        public readonly ?CoordinatesDto $coordinates = null,
        public readonly ?BuildingDto $building = null,
        public readonly ?ActivityDto $activity = null,
    ) {
        //
    }

    /**
     * Возвращает сериализованный объект для сохранения в кэш как ключ
     *
     * @return string
     */
    public function __toString()
    {
        return serialize($this);
    }
}
