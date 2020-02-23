<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

use App\logs_test;
use App\Accounts;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class logToFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Write:ToFile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'write text to file';

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
        
        $data = Accounts::getTokenName()->toArray();
        $responceData = [];
        
        if(count($data) != 0)
        {
            foreach ($data[0] as $elem)
            {   
                $url = $buildFacebookUrl->getAct_id($elem);
                $client = new Client();
                $request = $client->get($url);
                $response = $request->getBody();
                array_push($responceData, $response);  
            }

            DB::table('logs_test')->insert(['log_text' => $responceData]);
        }
        else{
            die();
        }
       // $logToBase->insert(['log_text' => '$responceText']);
        

    }
}
