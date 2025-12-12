<?php

namespace App\Console\Commands;

use App\Repositories\BuildingRepository;
use Illuminate\Console\Command;

class MeilisearchTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:meilisearch-test-command';

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
        $someStr = '1';

        $buildR = new BuildingRepository();

        $buildR->search($someStr);
    }
}
