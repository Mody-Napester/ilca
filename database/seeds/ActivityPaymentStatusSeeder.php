<?php

use Illuminate\Database\Seeder;

class ActivityPaymentStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Nothing Payed','Free','Down payment','Deposit','Final Payment'];

        foreach ($statuses as $status){
            \Illuminate\Support\Facades\DB::table('activity_payment_statuses')->insert([
                'uuid' => (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_ver')),
                'name' => $status,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
