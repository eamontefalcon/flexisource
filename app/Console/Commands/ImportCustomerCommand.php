<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Services\HttpClients\RandomUserApiClient;
use App\Services\RandomUserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ImportCustomerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customer';

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

        Artisan::command();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->alert('(Note: Customer count cannot be less than 100)');
        $customerCount = $this->ask('How many customer do you want to import?');

        if ((int)$customerCount < 100) {
            $this->alert('Failed to proceed');
            $this->info('This can only process minimum of 100 users');

            return false;
        }

        $randomUserService = new RandomUserService($customerCount);
        //request data
        $randomUsers = $randomUserService->request();
        //save data from Random User Service
        $randomUserService->save($randomUsers);

        $this->info('Done Importing customer wtih the total of '.$customerCount);
    }
}
