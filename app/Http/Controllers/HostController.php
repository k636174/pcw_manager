<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$hosts = \DB::select('SELECT `H`.id,`H`.hostname,`H`.created_at, `HS`.status, `HS`.lastcheck_at FROM ( `pcm_k636174_net`.`hosts` `H` LEFT JOIN `pcm_k636174_net`.`host_status` `HS` ON (`H`.`id` = `HS`.`host_id`) )');
        $hosts = \DB::select('SELECT hosts.id,hosts.hostname,hosts.created_at,host_status.lastcheck_at , host_status.status,host_ips.src_lip , host_ips.src_gip  FROM hosts JOIN host_status ON (hosts.id=host_status.host_id) LEFT JOIN host_ips ON (hosts.id=host_ips.host_id) order by host_ips.src_gip');
        return view('hosts.index')->with("hosts",$hosts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \DB::table('hosts')->where('id', $id )->first();
        return view('hosts.show')->with("data",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajax_loadaverage($id)
    {
        $sql = 'SELECT `H`.id,`H`.hostname,`H`.created_at, `LAVG`.loadavg_per1,`LAVG`.loadavg_per5,`LAVG`.loadavg_per15, `LAVG`.log_date FROM ( `pcm_k636174_net`.`hosts` `H` LEFT JOIN `pcm_k636174_net`.`loadaverage` `LAVG` ON (`H`.`id` = `LAVG`.`host_id`) ) WHERE `H`.id = '.$id.' AND `LAVG`.log_date >=sysdate() - interval 1 day order by `LAVG`.log_date desc limit 30';
        $loadavg = \DB::select($sql);

        $tmp_arr_loadavg_per1 = array();
        $tmp_arr_loadavg_per5 = array();
        $tmp_arr_loadavg_per15 = array();
        $tmp_arr_day = array();
        foreach($loadavg as $item){
            $tmp_arr_loadavg_per1[] = $item->loadavg_per1;
            $tmp_arr_loadavg_per5[] = $item->loadavg_per5;
            $tmp_arr_loadavg_per15[] = $item->loadavg_per15;
            $tmp_arr_day[] = $item->log_date;
        }
        return response()->json(
            array(
                'labels' => $tmp_arr_day,
                'datasets1' => array(
                    'label' => 'Last minute',
                    'data' =>  $tmp_arr_loadavg_per1,
                    'backgroundColor'=>'rgb(255,0,0)'
                ),
                'datasets5' => array(
                    'label' => 'Last 5 minutes',
                    'data' =>  $tmp_arr_loadavg_per5,
                    'backgroundColor'=>'rgb(3,0,255)'
                ),
                'datasets15' => array(
                    'label' => 'Last 15 minutes',
                    'data' =>  $tmp_arr_loadavg_per15,
                    'backgroundColor'=>'rgb(0,255,0)'
                )

            )
        );
    }


}
