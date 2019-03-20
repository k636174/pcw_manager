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
	    date_default_timezone_set('Asia/Tokyo');
        //Heart Beat
        $hostname = $request->hostname;
        $datetime = date("Y/m/d H:i:s");
        $src_lip = $request->src_lip;
        $src_gip = \Request::ip();

        $host_flag = \DB::table('hosts')->where('hostname', $hostname )->exists();
        if(!$host_flag){
                $sql = "INSERT INTO `hosts` (hostname, created_at) VALUES ('$hostname','$datetime') ON DUPLICATE KEY UPDATE hostname = VALUES (hostname);";
                \DB::statement($sql);
        }

        $host_data = \DB::table('hosts')->where('hostname', $hostname )->first();

        $host_id = $host_data->id;


        $sql = "INSERT INTO `host_status` (host_id, status, lastcheck_at, created_at) VALUES ('$host_id','Active','$datetime','$datetime') ON DUPLICATE KEY UPDATE lastcheck_at = VALUES (lastcheck_at),status = 'Active';";
        \DB::statement($sql);

        if(!$host_flag) {
            $sql = "INSERT INTO `group_host` (`host_id`, `group_id`) VALUES ('$host_id', '0');";
            \DB::statement($sql);
        }

        $sql = "INSERT INTO `host_ips` (host_id, src_gip, src_lip, created_at) VALUES ('$host_id','$src_gip','$src_lip','$datetime') ON DUPLICATE KEY UPDATE src_gip = '$src_gip',src_lip =  '$src_lip';";
        \DB::statement($sql);

        exit;
    }
}
