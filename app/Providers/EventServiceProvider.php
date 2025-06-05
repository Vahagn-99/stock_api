<?php

namespace App\Providers;

use App\Base\Organization\Events\Subscriptions\ClearCache;
use Event;

class EventServiceProvider extends \Illuminate\Events\EventServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot() : void
    {
        Event::subscribe(ClearCache::class);
    }
}
