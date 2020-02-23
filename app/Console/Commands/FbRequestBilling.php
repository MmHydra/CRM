<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Accounts;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class FbRequestBilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FbRequest:Billing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Requiries Billing Data from FB';

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
    public function handle(BuildFacebookUrl $buildFacebookUrl)
    { 
        $accounts = new Accounts;
        $data = $accounts->getTokenName();
        $responceData = [];
        foreach ($data as $elem)
        {
            $url = $buildFacebookUrl->billing($elem);

            $client = new Client();
            $request = $client->get($url);
            $response = $request->getBody();
            array_push($responceData, $response);  
        }
    }
    // записываем ответ в базу
    // $someModel = new ModelName;
    //  $someModel->methodUpdateTableBilling($responceData);
    
         
}

