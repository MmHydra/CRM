<?php

use Illuminate\Database\Seeder;

class ACT extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ACT')->insert([
                                    ['act_id' => '33333333333333333333',
                                	 'status_id' => '1',
                                	 'bm_id' => '12'
                                	],
                                	['act_id' => '3333333322222222222',
                                	 'status_id' => '1',
                                	 'bm_id' => '12'
                                	],


                                	['act_id' => '3211111111123213',
                                	 'status_id' => '1',
                                	 'bm_id' => '13'
                                	],
                                	['act_id' => '3342624324',
                                	 'status_id' => '1',
                                	 'bm_id' => '13'
                                	],


                                	['act_id' => '33331231545',
                                	 'status_id' => '1',
                                	 'bm_id' => '14'
                                	],
                                	['act_id' => '333333323463634634333',
                                	 'status_id' => '1',
                                	 'bm_id' => '14'
                                	],

                                	['act_id' => '3321536565533',
                                	 'status_id' => '1',
                                	 'bm_id' => '15'
                                	],
                                	['act_id' => '33321414213333',
                                	 'status_id' => '1',
                                	 'bm_id' => '15'
                                	],
                                ]);

    }
}
