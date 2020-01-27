<?php

use Illuminate\Database\Seeder;

class accountSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Accounts')->insert([
                                    ['account_name' => 'Andrey1',
                                	 'acc_owner' => 9,
                                	 'keitaro_comp_id' => 11111,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 1],

                                	 ['account_name' => 'Andrey2',
                                	 'acc_owner' => 9,
                                	 'keitaro_comp_id' => 11112,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 1],

                                	 ['account_name' => 'Andrey3',
                                	 'acc_owner' => 9,
                                	 'keitaro_comp_id' => 11113,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 2],

                                     ['account_name' => 'Masha1',
                                	 'acc_owner' => 9,
                                	 'keitaro_comp_id' => 11114,
                                	 'status_id' => 0,
                                	 'acc_proxy_id' => 3],



                                	  ['account_name' => 'Yulia1',
                                	 'acc_owner' => 11,
                                	 'keitaro_comp_id' => 11121,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 5],

                                	 ['account_name' => 'Yulia2',
                                	 'acc_owner' => 11,
                                	 'keitaro_comp_id' => 11122,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 5],

                                	 ['account_name' => 'Yulia3',
                                	 'acc_owner' => 11,
                                	 'keitaro_comp_id' => 11123,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 6],

                                     ['account_name' => 'Masha2',
                                	 'acc_owner' => 11,
                                	 'keitaro_comp_id' => 11124,
                                	 'status_id' => 0,
                                	 'acc_proxy_id' => 7],





                                	 ['account_name' => 'Maxim1',
                                	 'acc_owner' => 10,
                                	 'keitaro_comp_id' => 11121,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 9],

                                	 ['account_name' => 'Maxim2',
                                	 'acc_owner' => 10,
                                	 'keitaro_comp_id' => 11122,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 9],

                                	 ['account_name' => 'Maxim3',
                                	 'acc_owner' => 10,
                                	 'keitaro_comp_id' => 11123,
                                	 'status_id' => 1,
                                	 'acc_proxy_id' => 10],

                                     ['account_name' => 'Masha4',
                                	 'acc_owner' => 10,
                                	 'keitaro_comp_id' => 11124,
                                	 'status_id' => 0,
                                	 'acc_proxy_id' => 11],



                                ]);
    }
}


