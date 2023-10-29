@extends('layouts.main')

@section('meta-title')
    Leaderboard
@stop

@section('page-title')
    Leaderboard
@stop

@section('content')
    <div class="col-sm-12 col-lg-8 col-sm-offset-2">
        @foreach([
            'Last 3 months' => $threeMonths,
            'Year to date' => $thisYear,
            'Last year' => $lastYear,
            'All time' => $allTime,
        ] as $timePeriodLabel => $timePeriodData)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $timePeriodLabel }}</h3>
                </div>
                <div class="panel-body">
                    <p>This leaderboard celebrates members who have volunteered and trained new members on pieces of equipment.</p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Trainer</th>
                                <th>Inductions completed</th>
                            </tr>
                        </thead>
                        @foreach ($timePeriodData as $dodgyInductionRecord)
                            <tr>
                                <td>
                                    <a href="{{ route('account.show', $dodgyInductionRecord->trainerUser) }}">{{ $dodgyInductionRecord->trainerUser->display_name }}</a>
                                </td>
                                <td>
                                    {{ $dodgyInductionRecord->total }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@stop