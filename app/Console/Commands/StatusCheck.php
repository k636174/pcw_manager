<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StatusCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status_check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        date_default_timezone_set('Asia/Tokyo');

        for($i = 1; $i < 255; $i++){

            $datetime = date("Y/m/d H:i:s");
            $ip = "172.16.16.$i";
            exec("ping -v -c 1 $ip", $output, $status);
            if(strpos($output[1],'Unreachable') === false){

                $hostname = gethostbyaddr($ip);
                if(empty($host)){
                    $hostname = $ip;
                }

                $sql = "INSERT INTO `hosts` (hostname, created_at) VALUES ('$hostname','$datetime')";
                \DB::update($sql);

                $host_data = \DB::table('hosts')->where('hostname', $hostname )->first();
                $host_id = $host_data->id;

                $sql = "INSERT INTO `host_status` (host_id, status, lastcheck_at, created_at) VALUES ('$host_id','Active','$datetime','$datetime') ON DUPLICATE KEY UPDATE lastcheck_at = VALUES (lastcheck_at),status = 'Active';";
                \DB::update($sql);

            }
        }

        $sql = "UPDATE host_status SET status=\"Deactive\" WHERE status != \"Deactive\" AND lastcheck_at < CURRENT_TIMESTAMP + INTERVAL - 5 MINUTE";
        \DB::update($sql);
    }
}
