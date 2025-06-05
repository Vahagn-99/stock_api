<?php

namespace App\Base\Organization\Events;

use Illuminate\Foundation\Events\Dispatchable;

class OrganizationSaved
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
