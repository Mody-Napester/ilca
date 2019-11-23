<?php

use Illuminate\Database\Seeder;

class ActivityStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Pending','Translated','Edited','Delivered','In Review'];

        foreach ($statuses as $status){
            \Illuminate\Support\Facades\DB::table('activity_statuses')->insert([
                'uuid' => (string) \Webpatser\Uuid\Uuid::generate(config('vars.uuid_ver')),
                'name' => $status,
                'created_by' => 1,
                'updated_by' => 1
            ]);
        }
    }
}
