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

                $elem['updated_at'] = substr($elem['updated_at'], 0, 10);
                $sinceDate = $elem['updated_at'];
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
                        array_push($invalidIDs, $elem['id']);
                        array_push($logErrors, [$elem['id'] => $responce->error->message]);

                        continue;
                       
                    }
                    else
                    {
                        array_push($validIDs, $elem['id']);
                    }
                

                $answer = (array)$responce;
               
                $accounts = ((array)$answer["adaccounts"])['data'];
                $adsets = [];
                $adsetsCurency = [];
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
                    $adsetsCurencyID = ['adset_id' => $adsetAnswer->data[0]->id, 'curency' => $act_id->currency];
                    //dd($adsetsCurencyID);
                    $adsetsID  = $adsetAnswer->data[0]->id;

                    array_push($adsetsCurency, $adsetsCurencyID);
                    array_push($adsets, $adsetsID);
                    
                    

                    //dd($answer);
                }   

                    $insights = [];
                    
                foreach ($adsetsCurency as $adsetDataElem)
                {   
                    //dd($adsetDataElem);
                        
                    $endpoint = strval($adsetDataElem['adset_id']) . '/insights';
                    //dd($adsetDataElem->id);
                    $params = [
                        'access_token' => $elem,
                        'fields' => 'spend',
                        'time_range' => ['since' => $sinceDate, 'until' => $untilDate ],
                        'time_increment' => '1'
                    ];
                    $insights_dirty_url = $path . $endpoint . '/insights' . '?' . http_build_query($params);

                    $request = $client->get($insights_dirty_url);
                    $responce = $request->getBody();
                    $responce = $responce->getContents();
                    $answer = (array)json_decode($responce);
                    //dd($answer);
                    //array_push($insights, array_merge($answer, ['currency' => $act_id->currency],['adset_id' => $adsetDataElem->id]));
                    array_push($insights, array_merge($answer, $adsetDataElem));
                    
                    

                }
                    
                       
                    

                                            
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
        
            }
        }
        else{
            die();
        }
      //  dd($insights, $responce);

        $updateSpend = Accounts::updateDateSpend($validIDs, $untilDate);
        $updateInvalid = Accounts::updateStatus($invalidIDs, 0);
        $createLog = new logs_test;
        $createLog->log_text = json_encode($logErrors);
        $createLog->save();
    }   
}
