@extends('layouts.main')

@section('page-title')
    Member Storage - View Box
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Storage Box Information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h1>📦 Storage Location {{ $box->location }}</h2>
                            <h2>
                                @if($box->user)
                                    @if($box->user->active)
                                        🟡 Claimed 
                                    @else
                                        ⚠️ Member left
                                    @endif
                                @else
                                    @if ($box->location == "Old Members Storage")
                                        ⛔ Not available to be claimed
                                    @else
                                        🟢 Available
                                    @endif
                                @endif

                            </h2>
                            @if($box->user && $box->user->active)
                                <h4>
                                    This space has been claimed by
                                    `{{$box->user->name}}`
                                </h4>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4>QR code for storage location {{ $box->id }}</h4>
                            <img src="{{ $QRcodeURL }}">
                        </div>
                    </div>
                    
                </div>
            </div>
            </div>
    </div>
    @if (Auth::user()->isAdmin() || Auth::user()->hasRole('storage'))
    <h3>Admin</h3>
    <div class="row">
            <div class="col-md-12 well" style="background:repeating-linear-gradient( 45deg, #fafafa, #fafafa 40px, #fff 40px, #fff 80px )">
                <div class="row">
                    <div class="col-md-6">
                        @if($box->user)
                            {!! Form::open(array('method'=>'PUT', 'route' => ['storage_boxes.update', $box->id], 'class'=>'navbar-left')) !!}
                            {!! Form::hidden('user_id', '') !!}
                            {!! Form::submit('Reclaim', array('class'=>'btn btn-default btn-sm')) !!}
                            {!! Form::close() !!}                        
                        @endif
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(array('method'=>'PUT', 'route' => ['storage_boxes.update', $box->id])) !!}
                        {!! Form::select('user_id', [''=>'Allocate member']+$memberList, null, ['class'=>'form-control js-advanced-dropdown']) !!}
                        {!! Form::submit('✔️', array('class'=>'btn btn-default btn-xs')) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>    
        </div>
    @endif
@stop
