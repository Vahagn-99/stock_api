<?php

namespace App\Base\Activity\Events;

use Illuminate\Foundation\Events\Dispatchable;

class ActivityDeleted
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
