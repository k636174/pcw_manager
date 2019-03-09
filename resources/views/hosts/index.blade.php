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
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Active</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td style="color:red">rabbit2018.local</td>
                            <td style="color:black;background-color:red">Deactive</td>
                            <td style="color:red">2019/01/01</td>
                            <td style="color:red">2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr><th colspan="5" style="background-color:#00ced1;color:white">NOCIX拠点</th></tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td style="color:red">rabbit2018.local</td>
                            <td style="color:black;background-color:red">Deactive</td>
                            <td style="color:red">2019/01/01</td>
                            <td style="color:red">2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr><th colspan="5" style="background-color:#00ced1;color:white">自宅サーバ</th></tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr><th colspan="5" style="background-color:#00ced1;color:white">モバイル端末</th></tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        <tr>
                            <td style="color:red">rabbit2018.local</td>
                            <td style="color:black;background-color:red">Deactive</td>
                            <td style="color:red">2019/01/01</td>
                            <td style="color:red">2019/01/01</td>
                        </tr>
                        <tr>
                            <td>rabbit2018.local</td>
                            <td>Deactive</td>
                            <td>2019/01/01</td>
                            <td>2019/01/01</td>
                        </tr>
                        @foreach ($hosts as $host)
                            <tr>
                                <td>{{ $host->hostname }}</td>
                                <td>{{ $host->status }}</td>
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
