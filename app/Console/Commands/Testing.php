<?php

namespace App\Console\Commands;

use App\Base\Building\Events\BuildingSaved;
use App\Models\Building;
use Illuminate\Console\Command;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $building = Building::find(1);

        BuildingSaved::dispatch($building->id);
    }
}
