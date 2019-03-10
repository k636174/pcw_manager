<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Heart Beat
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function heartbeat(Request $request)
    {
        //Heart Beat
        $hostname = $request->hostname;
        $src_lip = $request->src_lip;
        $host_data = \DB::table('hosts')->where('hostname', $hostname )->first();

        $host_id = $host_data->id;
        $src_gip = \Request::ip();
        $datetime = date("Y/m/d H:i:s");


        $sql = "INSERT INTO `host_status` (host_id, status, lastcheck_at, created_at) VALUES ('$host_id','Active','$datetime','$datetime') ON DUPLICATE KEY UPDATE lastcheck_at = VALUES (lastcheck_at),status = 'Active';";
        \DB::statement($sql);

        $sql = "INSERT INTO `host_ips` (host_id, src_gip, src_lip, created_at) VALUES ('$host_id','$src_gip','$src_lip','$datetime') ON DUPLICATE KEY UPDATE src_gip = '$src_gip',src_lip =  '$src_lip';";
        \DB::statement($sql);

        exit;
    }
}
