<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\HostIp;

class XgAdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xg_add';

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

        $xg_ip = env('XG_MNT_ADDRESS');
        $xg_port = env('XG_MNG_PORT');
        $xg_user = env('XG_API_USER');
        $xg_password = env('XG_API_PASSWORD');

        $allow_ip = HostIp::get(['src_gip'])->groupBy('src_gip')->toArray();
        $tmp_ip = array();
        foreach($allow_ip as $ip_key => $ip){
            if(strpos($ip_key,'127.0.0.1') === false){
                $tmp_ip[$ip_key] = $ip_key;
            }
        }
        $replaced = implode(",",$tmp_ip);

        $url = "https://$xg_ip:$xg_port/webconsole/APIController";
        $input_xml = "<Request><Login><Username>$xg_user</Username><Password>$xg_password</Password></Login><Set><IPHost><Name>PCW_MANAGER</Name><IPFamily>IPv4</IPFamily><HostType>IPList</HostType><ListOfIPAddresses>$replaced</ListOfIPAddresses></IPHost></Set></Request>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_URL, $url."?reqxml=" . urlencode($input_xml));
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,300);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        if (curl_error($ch)) {
            echo 'error:' . curl_error($ch);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        $array_data = simplexml_load_string($data);
        exit;

    }
}
