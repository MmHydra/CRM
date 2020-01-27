<?php

use Illuminate\Database\Seeder;

class BusinessManager extends Seeder{
  public function run()
    {
        DB::table('BusinessManager')->insert([
                                    ['acc_name' => 'business01',
                                	 'bm_token' => 111111111111001,
                                	 'acc_id' => 13,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business02',
                                	 'bm_token' => 111111111111002,
                                	 'acc_id' => 14,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business03',
                                	 'bm_token' => 111111111111003,
                                	 'acc_id' => 15,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business04',
                                	 'bm_token' => 111111111111004,
                                	 'acc_id' => 16,
                                	 'status_id' => 1],


                                	  ['acc_name' => 'business11',
                                	 'bm_token' => 111111111111011,
                                	 'acc_id' => 17,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business12',
                                	 'bm_token' => 111111111111012,
                                	 'acc_id' => 18,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business13',
                                	 'bm_token' => 111111111111013,
                                	 'acc_id' => 16,
                                	 'status_id' => 1],


                                	  ['acc_name' => 'business14',
                                	 'bm_token' => 111111111111014,
                                	 'acc_id' => 17,
                                	 'status_id' => 1],


                  					


 									  ['acc_name' => 'business01',
                                	 'bm_token' => 111111111111021,
                                	 'acc_id' => 19,
                                	 'status_id' => 1],

                                	  ['acc_name' => 'business01',
                                	 'bm_token' => 111111111111023,
                                	 'acc_id' => 24,
                                	 'status_id' => 1],

 									  ['acc_name' => 'business01',
                                	 'bm_token' => 111111111111025,
                                	 'acc_id' => 23,
                                	 'status_id' => 1],




                                	


                                ]);
    }
}
