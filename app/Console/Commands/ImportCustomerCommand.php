<?php

namespace App\Console\Commands;

use App\Services\HttpClients\RandomUserApiClient;
use App\Services\RandomUserService;
use Illuminate\Console\Command;

class ImportCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customer {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import new customer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ((int)$this->argument('count') < 100) {
            $this->alert('Failed to proceed');
            $this->info('This can only process minimum of 100 users');

            return false;
        }

        $randomUserService = new RandomUserService($this->argument('count'));
        //request data
        $randomUsers = $randomUserService->request();
        //save data from Random User Service
        $randomUserService->save($randomUsers);

        $this->info('Done Importing data total of '. $this->argument('count'));
    }
}
