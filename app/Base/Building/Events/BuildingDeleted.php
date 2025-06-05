<?php

namespace App\Base\Building\Events;

use Illuminate\Foundation\Events\Dispatchable;

class BuildingDeleted
{
    use Dispatchable;

    /**
     * Create a new event instance.
     *
     * @param int $id
     */
    public function __construct(public readonly int $id) {
        //
    }
}
