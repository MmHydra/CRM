<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Accounts;
use App\Proxy;
use App\logs_test;
use GuzzleHttp\Client;

class GetAccountsFBtool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getAccounts:FBtool';

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
        $arrCreateAccounts = [];
		$arrUpdateAccounts = [];
		$arrProxyCreate = [];

		$proxyUpdated = 0;


		$accounts = new Accounts();
		$dataAccounts = $accounts->select(['account_name', 'token_fb'])->get()->toArray();

		$proxy = new Proxy();
		$dataProxy = $proxy->select(['id', 'ip', 'port', 'login', 'password'])->get()->toArray();
		
		//$client = new Client(['http_errors' => false]);
        //$request = $client->get("https://fbtool.pro/api/get-accounts?key=iARAAWTY3uWAml7cexh9Q57n5kybMp3t");

        $client = new Client(['http_errors' => false]);
        $request = $client->get("https://fbtool.pro/api/get-proxy?key=iARAAWTY3uWAml7cexh9Q57n5kybMp3t");
         //$request = $client->get("https://fbtool.pro/api/get-account-proxy?key=iARAAWTY3uWAml7cexh9Q57n5kybMp3t");
        $responce = $request->getBody();
	    $responce = get_object_vars(json_decode($responce->getContents()));

        foreach($responce as $elem){

        	$elem = (array)$elem;
        	if(array_key_exists('proxy', $elem)){
        		if(array_search($elem['id'], array_column($dataProxy, 'id')) === false){
      				$keys = ['ip', 'port', 'login', 'password', 'proxy_type', 'id'];
      				$val = explode(":", $elem['proxy']);
      				$val[4] = $elem['type'];
      				$val[5] = $elem['id'];
      				array_push($arrProxyCreate, array_combine($keys, $val));
        		}
        		else{
        			$keys = ['ip', 'port', 'login', 'password'];
        			$val = explode(":", $elem['proxy']);
        			$arrProxyUpdate = array_combine($keys, $val);

        			$proxy->where('id', $elem['id'])->update([
						'ip' => $arrProxyUpdate['ip'],
						'port' => $arrProxyUpdate['port'],
						'login' => $arrProxyUpdate['login'],
						'password' => $arrProxyUpdate['password'],
					]);

        			$proxyUpdated++;
        		}
        	}
        }
       


        if(count($arrProxyCreate) !== 0){
			$proxy::insert($arrProxyCreate);
		}

		$client = new Client(['http_errors' => false]);
        $request = $client->get("https://fbtool.pro/api/get-accounts?key=iARAAWTY3uWAml7cexh9Q57n5kybMp3t");

        $responce = $request->getBody();
	    $responce = get_object_vars(json_decode($responce->getContents()));
	  	
		foreach($responce as $elem){
			$elem = (array)$elem;
			
			if(array_key_exists('name', $elem)){
				if($elem['status'] == 1){	
					if(array_search($elem['name'], array_column($dataAccounts, 'account_name')) === false)
					{	
						array_push($arrCreateAccounts, ['account_name' => $elem['name'], 'token_fb' => $elem['access_token'],'acc_owner' => 10, 'updated_at' => '2020-01-01', 'keitaro_comp_id' => '1',
							'status_id' => '1', 'BillingInUse' => 1, 'acc_proxy_id' => $elem['proxy'],'user_agent' => $elem['user_agent'],]);			
					}
					array_push($arrUpdateAccounts, ['account_name' => $elem['name'], 'token_fb' => $elem['access_token'], 'acc_proxy_id' => $elem['proxy'], 'user_agent' => $elem['user_agent'],]);
				
				}
			}

		}
		//dd($arrUpdateAccounts, $arrCreateAccounts);
		if(count($arrCreateAccounts) !== 0){
		$accounts::insert($arrCreateAccounts);
		}

		if(count($arrUpdateAccounts) !== 0){
			foreach($arrUpdateAccounts as $elem){
				$accounts->where('account_name', $elem['account_name'])->update([
					'token_fb' => $elem['token_fb'],
					'status_id' => '1',
					'acc_proxy_id' => $elem['acc_proxy_id'],
					'user_agent' => $elem['user_agent'],
				]);
			}
		}
		
		$log = new logs_test();
		$log->log_text = 'Аккаунтов добавлено: ' . count($arrCreateAccounts) . ' Аккаунтов обновлено: ' . count($arrUpdateAccounts);
        $log->save();
    }
}
