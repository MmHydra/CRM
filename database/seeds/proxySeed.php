<?php

use Illuminate\Database\Seeder;

class proxySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('Proxy')->insert([
                                    ['ip' => '100.10.10.1',
                                	 'port' => '6000',
                                	 'login' => 'login11',
                                	 'password' => 'pass11',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.10.2',
                                	 'port' => '6001',
                                	 'login' => 'login12',
                                	 'password' => 'pass12',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.10.3',
                                	 'port' => '6002',
                                	 'login' => 'login13',
                                	 'password' => 'pass13',
                                	 'proxy_type' => 'socks'],

                                      ['ip' => '100.10.10.4',
                                	 'port' => '6003',
                                	 'login' => 'login14',
                                	 'password' => 'pass14',
                                	 'proxy_type' => 'socks'],



                                	  ['ip' => '100.10.11.1',
                                	 'port' => '6010',
                                	 'login' => 'login21',
                                	 'password' => 'pass21',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.11.2',
                                	 'port' => '6011',
                                	 'login' => 'login22',
                                	 'password' => 'pass22',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.11.3',
                                	 'port' => '6012',
                                	 'login' => 'login23',
                                	 'password' => 'pass23',
                                	 'proxy_type' => 'socks'],

                                      ['ip' => '100.10.11.4',
                                	 'port' => '6013',
                                	 'login' => 'login24',
                                	 'password' => 'pass24',
                                	 'proxy_type' => 'socks'],





                                	  ['ip' => '100.10.12.1',
                                	 'port' => '6030',
                                	 'login' => 'login31',
                                	 'password' => 'pass31',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.12.2',
                                	 'port' => '6031',
                                	 'login' => 'login32',
                                	 'password' => 'pass32',
                                	 'proxy_type' => 'socks'],

                                	  ['ip' => '100.10.12.3',
                                	 'port' => '6032',
                                	 'login' => 'login33',
                                	 'password' => 'pass33',
                                	 'proxy_type' => 'socks'],

                                      ['ip' => '100.10.12.4',
                                	 'port' => '6033',
                                	 'login' => 'login34',
                                	 'password' => 'pass34',
                                	 'proxy_type' => 'socks'],]);
    }
}
