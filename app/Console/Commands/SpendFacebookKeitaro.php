<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Accounts;
use App\Proxy;
use App\logs_test;
//use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class SpendFacebookKeitaro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recievePush:facebookKeitaro';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        
    

        $logErrors = [];
		
		$logAll = [];
        $validIDs = [];
        $invalidIDs = [];
        $data = Accounts::getDataForSpend();
        $untilDate = date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"),date("Y")));
        $responceData = [];
       

        if(count($data) != 0)
        {   
            foreach ($data as $elem)
           {    
                $logAccount = [];
                if($elem['acc_proxy_id'] != null)
                {
                    $elemProxy = $elem->proxyes['proxy_type'] . '://' . $elem->proxyes['login'] . ':' . $elem->proxyes['password'] . '@' . $elem->proxyes['ip'] . ':' . $elem->proxyes['port'];
                }
                else
                {
                    $elemProxy = null;
                }
                $currentRowId = $elem['id'];
						   
				array_push($logAccount,[ 'id' => $currentRowId]);

                $sinceDate = substr($elem['updated_at'], 0, 10);
                $path = 'https://graph.facebook.com/v5.0/';
                $endpoint = 'me';
                $params = [
                            'access_token' => $elem['token_fb'],
                            
                            
                            'fields' => 'adaccounts{name,business,account_id,id,currency}',
                ];

                $url = $path . $endpoint . '?' . http_build_query($params);

                $client = new Client(['http_errors' => false]);
                try {
                       $request = $client->request('GET', $url,   
                            ['body' => json_encode($params),
                            
                            'connect_timeout' => 2,
                             'proxy' => $elemProxy,
                             'headers' => [ 'User-Agent' => $elem['user_agent'],
                                            'Api-Key' => '02acaa330ea77b057e680fbd23f78c91'
                                          ],
                            ]);
                        if($request->getStatusCode() == 0){
                            throw new \Exception('Failed');
                        }
                } 
                catch(\GuzzleHttp\Exception\ConnectException $e){
                    array_push($invalidIDs, $currentRowId);
                    
                    array_push($logAccount,[ 'ErrorMsg' => 'Connection timed out'] );
                    array_push($logAll,$logAccount); 
                    continue;  
                }
                  
                $responce = $request->getBody();
                $responce = json_decode($responce->getContents());
                 // dd($responce, $logAll);
					if(isset($responce->error)){
                        
                        array_push($invalidIDs, $currentRowId);
						array_push($logAccount,[ 'ErrorMsg' => $responce->error->message] );
						array_push($logAll,$logAccount);
                        continue;
                       
                    }

                

                 $answer = (array)$responce;
               
                $accounts = ((array)$answer["adaccounts"])['data'];
                $adsets = [];
                $adsetsCurency = [];
				$i=0;
                foreach($accounts as $act_id)
                {
                    $endpoint = strval($act_id->id) . '/adsets';
                    $params = [
                            'access_token' => $elem['token_fb'],            
                    ];
                    $adsets_dirty_url = $path .  $endpoint . '?' . http_build_query($params);
                    
                    $request = $client->get($adsets_dirty_url);
                    $responce = $request->getBody();
                    $responce = $responce->getContents();
					$adsetAnswer = json_decode($responce);
					if(isset($answer->error)){
                        array_push($invalidIDs, $currentRowId);
						array_push($logAccount,[ 'ErrorMsg' => $answer->error->message] );
						array_push($logAll,$logAccount);
                        continue 2;
                       
                    }
					foreach($adsetAnswer->data as $adsetsIDs){
						array_push($adsetsCurency, ['adset_id' => $adsetsIDs->id, 'curency' => $act_id->currency]);
						array_push($adsets,$adsetsIDs->id);
					}
                    
                    
                    

                    
                }   

                    $insights = [];
                    
                foreach ($adsetsCurency as $adsetDataElem)
                {   
                    
                        
                    $endpoint = strval($adsetDataElem['adset_id']) . '/insights';
                    
                    $params = [
                        'access_token' => $elem['token_fb'],
                        'fields' => 'spend',
                        'time_range' => ['since' => $sinceDate, 'until' => $untilDate ],
                        'time_increment' => '1'
                    ];
					
                    $insights_dirty_url = $path . $endpoint . '/insights' . '?' . http_build_query($params);
					
                    $request = $client->get($insights_dirty_url);
                    $responce = $request->getBody();
                    $responce = $responce->getContents();
					
					
                    $answer = (array)json_decode($responce);
					if(isset($answer['error'])){
                        array_push($invalidIDs, $currentRowId);
						array_push($logAccount,[ 'ErrorMsg' => $answer['error']->message] );
						array_push($logAll,$logAccount);
                        continue 2;
                       
                    }
                    array_push($insights, array_merge($answer, $adsetDataElem));
                    
                    

                }
				
				
                array_push($logAccount,[ 'insights' => $insights] );    
                                            
                        $params = [ 
                                    
                                    'range' => [
                        
                                        'from' => $sinceDate,
                                        'to' => $untilDate,
                                        'timezone' => 'Europe/Moscow' //возможно стоит помен¤ть на киев
                                     ],
                                    'grouping' => ['campaign_id'],
                                    'metrics' => ['campaign_id'],
                                    'filters' => [
                                        ['name' => 'ad_campaign_id', 'operator' => 'IN_LIST', 'expression' => $adsets,
                                        ],
                                    ],
                        ];                    
                        $request = $client->request('POST', 'http://gg-team.ru/admin_api/v1/report/build',   
                            ['body' => json_encode($params),
                             'headers' => [
                                          'Api-Key' => '02acaa330ea77b057e680fbd23f78c91'
                                          ],
                            ]);

                        $responce = $request->getBody();
                        $responce = $responce->getContents();
                        $keitaroCampaigns = json_decode($responce)->rows;
						array_push($logAccount,[ 'keitaroCampaigns' => json_encode($keitaroCampaigns)] ); 
                        foreach ($insights as $elem) 
                        {   
                            $keitaro_curency = $elem['curency'];
                            $keitaro_adset_id = $elem['adset_id'];

                            foreach ( $elem['data'] as $insight) 
                            {   
                                $keitaro_data = [
                                    'start_date' => $insight->date_start . ' 00:00:00',
                                    'end_date' => $insight->date_start . ' 23:59:59',
                                    'cost' => $insight->spend,
                                    'currency' => $elem['curency'],
                                    'timezone' => 'Europe/Moscow',
                                    'only_campaign_uniques' => 1,
                                    'filters' => ['ad_campaign_id' =>  $elem['adset_id']],
                                ];

                                foreach ($keitaroCampaigns as $keitaro_campaign) 
                                {   
                                    $request = $client->request('POST', 'http://gg-team.ru/admin_api/v1/campaigns/'. $keitaro_campaign->campaign_id . '/update_costs',   
                                        [
                                         'body' => json_encode($keitaro_data),
                                         'headers' => ['Api-Key' => '02acaa330ea77b057e680fbd23f78c91'],
                                        ]);
                                    
                                }
                            }
                        } 
				array_push($logAccount,[ 'isValidToken' => '1'] );
				//dd($elem);
                array_push($validIDs, $currentRowId);						
				array_push($logAll,$logAccount);
            }
        }
        else{
            die();
        }
		
        $updateSpend = Accounts::updateDateSpend($validIDs, $untilDate);
        $updateInvalid = Accounts::updateStatus($invalidIDs, 0);

        $createLog = new logs_test;
        $createLog->log_text = json_encode($logAll);
        $createLog->save();
    }   
}
