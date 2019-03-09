@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                            <th>データ受信日時</th>
                            <th>監視開始日時</th>
                            <th>詳細情報</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr><th colspan="5" style="background-color:#00ced1;color:white">モバイル端末</th></tr>
                        @foreach ($hosts as $host)
                            <tr class="{{ mb_strtolower($host->status) }}">
                                <td>{{ $host->hostname }}</td>
                                <td class="td_{{ mb_strtolower($host->status) }}">{{ $host->status }}</td>
                                <td>{{ $host->lastcheck_at }}</td>
                                <td>{{ $host->created_at }}</td>
                                <td><a href="/hosts/{{ $host->id }}">SERVER</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
