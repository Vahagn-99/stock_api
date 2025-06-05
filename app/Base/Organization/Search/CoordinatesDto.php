<?php

declare(strict_types=1);


namespace App\Base\Organization\Search;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class CoordinatesDto extends Data
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     */
    public function __construct(
        #[Rule('required', 'numeric')]
        public readonly float $latitude,
        #[Rule('required', 'numeric')]
        public readonly float $longitude,
        #[Rule('required', 'numeric', 'min:0', 'max:10000')]
        public readonly float $radius = 1000,
    ) {
        //
    }
}
