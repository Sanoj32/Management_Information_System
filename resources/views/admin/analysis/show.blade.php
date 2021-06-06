@extends('layouts.app')
@section('content')
<?php 
use App\Models\BctSubject;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Closed Attendances</h2>
            @foreach ($semesters as $semester)

            <div class="card">
                <div class="card-header">{{getSemester($semester)}} semester</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($reports as $report)
                        @if($report->semester == $semester)


                        <li class="list-group-item disabled">{{$report->subject_name}}</li>
                        <div>
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                        <script>
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar'
                                , data: {
                                    labels:  ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange']
                                    , datasets: [{
                                        label: 'Present Count'
                                        , data: [12, 19, 3, 5, 2, 3]
                                        , backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)'
                                            , 'rgba(54, 162, 235, 0.2)'
                                            , 'rgba(255, 206, 86, 0.2)'
                                            , 'rgba(75, 192, 192, 0.2)'
                                            , 'rgba(153, 102, 255, 0.2)'
                                            , 'rgba(255, 159, 64, 0.2)'
                                        ]
                                        , borderColor: [
                                            'rgba(255, 99, 132, 1)'
                                            , 'rgba(54, 162, 235, 1)'
                                            , 'rgba(255, 206, 86, 1)'
                                            , 'rgba(75, 192, 192, 1)'
                                            , 'rgba(153, 102, 255, 1)'
                                            , 'rgba(255, 159, 64, 1)'
                                        ]
                                        , borderWidth: 1
                                    }]
                                }
                                , options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                        </script>

                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
