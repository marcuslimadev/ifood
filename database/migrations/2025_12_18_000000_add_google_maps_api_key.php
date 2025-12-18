<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddGoogleMapsApiKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $map_api_key = 'AIzaSyConSsO9QH4rpNGF42FqA5gk9v9Q61ZxK8';

        // Insert map_api_key (client)
        DB::table('business_settings')->updateOrInsert(
            ['key' => 'map_api_key'],
            [
                'key' => 'map_api_key',
                'value' => $map_api_key,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Insert map_api_key_server (server)
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('business_settings')->where('key', 'map_api_key')->delete();
        DB::table('business_settings')->where('key', 'map_api_key_server')->delete();
    }
}
