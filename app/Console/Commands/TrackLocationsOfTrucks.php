<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrackLocationsOfTrucks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track locations of carrier trucks';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info('called every minute');
        return Command::SUCCESS;
    }
}
