<?php

declare(strict_types=1);


namespace App\Base\Organization\Search;

use Spatie\LaravelData\Data;

class BuildingDto extends Data
{
    /**
     * @param string $address
     */
    public function __construct(
        public readonly string $address
    ) {
        //
    }
}
