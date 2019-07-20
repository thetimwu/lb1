<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';

    //protected $signature = 'contact:company {name} {phone?}';

    // another way to set default value for the optional argument
    // in this case, the default value is N/A
    //protected $signature = 'contact:company {name} {phone=N/A}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new company';

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
        $name = $this->ask('What is the company name?');
        $phone = $this->ask('What is the company\'s phone number?');

        if ($this->confirm('Are you ready to insert "' . $name . '"?')){
            $company = Company::create([
                'name' => $name,
                'phone' => $phone,
            ]);

            return $this->info('Added: ' . $company->name);
        }
        // $company = Company::create([
        //     'name' => $this->argument('name'),
        //     'phone' => $this->argument('phone') ?? 'N/A',

        //     //if default value is set in the $signature, the use the line below
        //     // the results is the same as above line
        //     // 'phone' => $this->argument('phone')
        // ]);

        $this->info('Added: ' . $company->name);

    }
}
