@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Change logs</h1>
            <ul>
                <li class="pb-3">
                    <h4>2021/5/15</h3>
                        Fixed crash if day > 6 [Bugfix]
                </li>
                <li class="pb-3">
                    <h4>2021/5/14</h3>
                        Made the latest attendance apperar on the first column to save scrolling time [UX Enhancement]
                        <br>
                        Made a Preset/Total Classes column appear after 5 classes [Feature/UX]
                </li>
                <li class="pb-3">
                    <h4>2021/5/12</h3>
                        Edit Attendance Added [Feature Addition]
                </li>
                <li class="pb-3">
                    <h4>2021/5/10</h3>
                        Working Demo Completed
                </li>
            </ul>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>
@endsection
