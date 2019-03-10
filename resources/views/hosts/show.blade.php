@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $data->hostname }}</div>

                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // 追加で使うJavaScript-->
<script>
    window.onload = function(){
        // データ再取得関数
        function refresh_data(){
            // 今年に入っての日別攻撃件数グラフ
            $.ajax({
                type: 'GET',
                url: '/ajax_loadaverage/{{ $data->id }}',
                dataType: "json",
                success: function (result, textStatus, jqXHR)
                {
                    var day_graph2 = document.getElementById("myChart").getContext('2d');
                    var myChart2 = new Chart(day_graph2,{
                        type: "line",
                        data: {},
                        option: {}
                    });
                    myChart2.data = {
                        labels: result.labels,
                        datasets: [
                            {
                                label: result.datasets1.label,
                                borderColor : result.datasets1.backgroundColor,
                                data : result.datasets1.data,
                                fill:false
                            },
                            {
                                label: result.datasets5.label,
                                borderColor : result.datasets5.backgroundColor,
                                data : result.datasets5.data,
                                fill:false
                            },
                            {
                                label: result.datasets15.label,
                                borderColor : result.datasets15.backgroundColor,
                                data : result.datasets15.data,
                                fill:false
                            }
                        ]
                    };
                    myChart2.update();
                    $("#refreshing5").html("");
                }
            });
        }
        refresh_data();
        // 30秒毎に再取得
        setInterval(function(){
            refresh_data();
        },60000);
    };
</script>

@endsection
