<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Accounts;
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
                       

     
        //$data = ['EAABsbCS1iHgBACj9Ad5vq7FNVJGAkHfqrWB3xyLWp9HEHHIK3NaImOZAduWDG78byZCaw4lqrJXwpietHlhuKdzhpBWBKHE7fpRtbaQ9PHRfKtS0KqcCNssku0Hg69Kd8rXVbksL9IwhF20zHyAg3PKZCnOdhJ03D5NyAiOmwZDZD'];
        $responceData = [];
       
        //dd($data);
        if(count($data) != 0)
        {   
            foreach ($data as $elem)
           {     
				$currentRowId = $elem['id'];
				$logAccount = [];		   
				array_push($logAccount,[ 'id' => $currentRowId] );
				//dd($elem['id']);
               // $elem['updated_at'] = substr($elem['updated_at'], 0, 10);
                $sinceDate = substr($elem['updated_at'], 0, 10);//substr('2020-02-24T00:00:00.000000Z', 0, 10);//$elem['updated_at'];
                $path = 'https://graph.facebook.com/v5.0/';
                $endpoint = 'me';
                $params = [
                            'access_token' => $elem['token_fb'],
                            //'access_token' => $elem['token_fb'],
                            
                            'fields' => 'adaccounts{name,business,account_id,id,currency}',
                ];

                $url = $path . $endpoint . '?' . http_build_query($params);
        
                  
                //dd($url);
                $client = new Client(['http_errors' => false]);

                    $request = $client->get($url);
                    $responce = $request->getBody();
                    $responce = json_decode($responce->getContents());
					if(isset($responce->error)){
                        array_push($invalidIDs, $currentRowId);
                        //array_push($logErrors, [$elem['id'] => $responce->error->message]);
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
                    //dd(1234, $invalidIDs, $logErrors);
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
                        //array_push($logErrors, [$elem['id'] => $responce->error->message]);
						array_push($logAccount,[ 'ErrorMsg' => $answer->error->message] );
						array_push($logAll,$logAccount);
                        continue 2;
                       
                    }
                    //if($i++ == 1)dd($adsetAnswer);
                    /* $adsetsCurencyID = ['adset_id' => $adsetAnswer->data[0]->id, 'curency' => $act_id->currency];
                    //dd($adsetsCurencyID);
                    $adsetsID  = $adsetAnswer->data[0]->id;
					array_push($adsetsCurency, $adsetsCurencyID);
                    array_push($adsets, $adsetsID); */
					foreach($adsetAnswer->data as $adsetsIDs){
						array_push($adsetsCurency, ['adset_id' => $adsetsIDs->id, 'curency' => $act_id->currency]);
						array_push($adsets,$adsetsIDs->id);
						//array_merge($adsetsID,$adsetsIDs->id);
					}
                    
                    
                    

                    //dd($answer);
                }   

                    $insights = [];
                    
                foreach ($adsetsCurency as $adsetDataElem)
                {   
                    //dd($adsetDataElem);
                        
                    $endpoint = strval($adsetDataElem['adset_id']) . '/insights';
                    //dd($adsetDataElem->id);
                    $params = [
                        'access_token' => $elem['token_fb'],
                        'fields' => 'spend',
                        'time_range' => ['since' => $sinceDate, 'until' => $untilDate ],
                        'time_increment' => '1'
                    ];
					//array_push($logAccount,$params);
                    $insights_dirty_url = $path . $endpoint . '/insights' . '?' . http_build_query($params);
					//array_push($logAccount,$insights_dirty_url);
                    $request = $client->get($insights_dirty_url);
                    $responce = $request->getBody();
                    $responce = $responce->getContents();
					
					//dd($responce);
                    $answer = (array)json_decode($responce);
					if(isset($answer['error'])){
                        array_push($invalidIDs, $currentRowId);
                        //array_push($logErrors, [$elem['id'] => $responce->error->message]);
						array_push($logAccount,[ 'ErrorMsg' => $answer['error']->message] );
						array_push($logAll,$logAccount);
                        continue 2;
                       
                    }
                    //dd($answer);
                    //array_push($insights, array_merge($answer, ['currency' => $act_id->currency],['adset_id' => $adsetDataElem->id]));
                    array_push($insights, array_merge($answer, $adsetDataElem));
                    
                    

                }
				
				
                array_push($logAccount,[ 'insights' => $insights] );    
				//dd($insights);
                       
                    

                                            
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
                        //dd($params, json_encode($params));

                        
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
                        {   //dd($elem);
                            $keitaro_curency = $elem['curency'];
                            $keitaro_adset_id = $elem['adset_id'];

                            foreach ( $elem['data'] as $insight) 
                            {   //dd($insight);
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
                                    

                                    //$responce = $responce->getContents();
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
      //  dd($insights, $responce);
		
        $updateSpend = Accounts::updateDateSpend($validIDs, $untilDate);
        $updateInvalid = Accounts::updateStatus($invalidIDs, 0);
		//dd($logAll);
        $createLog = new logs_test;
        $createLog->log_text = json_encode($logAll);//json_encode($logErrors);
        $createLog->save();
    }   
}
