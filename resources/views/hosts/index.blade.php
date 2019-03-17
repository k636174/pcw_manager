@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table style="background-color:black;color:#c5faff;width:100%" border="1">
                        <thead>
                        <tr>
                            <th>ホスト名</th>
                            <th>Status</th>
                            <th>ホストIP</th>
                            <th>NAT_IP</th>
                            <th>データ受信日時</th>
                            <th>監視開始日時</th>
                            <th>詳細情報</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $host_tmp = ""; ?>
                        @foreach ($groups as $group)
                            @if ($host_tmp != $group["groupname"])
                                <tr><th colspan="7" style="background-color:#00ced1;color:white">{{ $group["groupname"] }}</th></tr>
                            @endif
                            @foreach ($hosts as $host)
                                @if ($host_tmp = $host->groups[0]->groupname == $group["groupname"])
                                    <tr class="{{ mb_strtolower($host->host_status->status) }}">
                                        <td>{{ $host->hostname }}</td>
                                        <td class="td_{{ mb_strtolower($host->host_status->status) }}">{{ $host->host_status->status }}</td>
                                        <td>{{ $host->host_ips->src_lip }}</td>
                                        <td>{{ $host->host_ips->src_gip }}</td>
                                        <td>{{ $host->host_status->lastcheck_at }}</td>
                                        <td>{{ $host->created_at }}</td>
                                        <td><a href="/hosts/{{ $host->id }}">SERVER</a></td>
                                    </tr>
                                @endif
                            @endforeach
                            <?php $host_tmp = $group["groupname"]; ?>
                        @endforeach
                        </tbody>



                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
