<?php

declare(strict_types=1);


namespace App\Base\Organization\Search;

use Spatie\LaravelData\Data;

class ActivityDto extends Data
{
    /**
     * @param string $name
     * @param bool $deep_search
     */
    public function __construct(
        public readonly string $name,
        public readonly bool $deep_search = false,
    ) {
        //
    }
}
