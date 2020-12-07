<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $oc = DB::table('oauth_clients')->where('secret', "P1vyLEdOp43P9IhssnhWEYrqRCLa7FwTTxf3to8O")->first();
        if(empty($oc)){
            try {
                DB::insert("INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
                    (1, NULL, 'Lumen Personal Access Client', 'wMUTfV4TeRPisvlBzHXP60fJOoNPJACxxZK63ojG', '', 'http://localhost', 1, 0, 0, '2020-04-14 17:07:14', '2020-04-14 17:07:14');
                ");
                DB::insert("INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
                    (2, NULL, 'Lumen Password Grant Client', 'P1vyLEdOp43P9IhssnhWEYrqRCLa7FwTTxf3to8O', 'users', 'http://localhost', 0, 1, 0, '2020-04-14 17:07:14', '2020-04-14 17:07:14');
                ");
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
