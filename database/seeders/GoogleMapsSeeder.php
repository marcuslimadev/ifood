<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleMapsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $map_api_key = 'AIzaSyConSsO9QH4rpNGF42FqA5gk9v9Q61ZxK8';

        // Insert or update map_api_key (client)
        DB::table('business_settings')->updateOrInsert(
            ['key' => 'map_api_key'],
            [
                'key' => 'map_api_key',
                'value' => $map_api_key,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Insert or update map_api_key_server (server)
        DB::table('business_settings')->updateOrInsert(
            ['key' => 'map_api_key_server'],
            [
                'key' => 'map_api_key_server',
                'value' => $map_api_key,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
