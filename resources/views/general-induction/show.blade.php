@extends('layouts.main')

@section('meta-title')
    Complete a member's general induction
@stop

@section('page-title')
    General Induction and Tour
@stop

@section('content')
    <div class="col-sm-12 col-lg-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">General Induction and Tour</h3>
            </div>
            <div class="panel-body">
                <p>We make sure all members are introduced to Hackspace Manchester when they join, which we do through our
                    General Induction.</p>

                <p>This is an in-person tour of the space, where we will:</p>

                <ul>
                    <li>Show off our workshops and the equipment we have within them</li>
                    <li>Cover basic rules and health &amp; safety</li>
                    <li>Explain how the Hackspace works (we're run by our members!)</li>
                    <li>Answer any questions you have!</li>
                </ul>

                <p>At the end of your general induction we'll give you a code to enter on this page. This proves you've been
                    along to the induction, and will allow you to set up your 24/7 access to the space.</p>

                <p>We run these tours every week for prospective and newly joined members. See our <a
                        href="https://www.hacman.org.uk/visit-us/" target="_blank" rel="noopener">Visit Us</a> page for
                    timings.</p>

                <p>You can also reach out on <a href="https://docs.hacman.org.uk/Telegram/" target="_blank"
                        rel="noopener">Telegram</a> to organise an ad-hoc induction, if any members are free and able to
                    do so.</p>
            </div>
        </div>

        @if (!$user->induction_completed)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Mark your General Induction as completed</h3>
                </div>
                <div class="panel-body">
                    <p>To complete your general induction, enter the code given to you at the end of your induction here.
                    </p>

                    {!! Form::open(['route' => 'general-induction.update', 'class' => 'form-horizontal', 'method' => 'PUT']) !!}

                    <div
                        class="form-group {{ FlashNotification::hasErrorDetail('induction_code', 'has-error has-feedback') }}">
                        {!! Form::label('induction_code', 'Induction Code', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9 col-lg-7">
                            {!! Form::text('induction_code', null, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! FlashNotification::getErrorDetail('induction_code') !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                            {!! Form::submit('Complete General Induction', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">How to give a General Induction</h3>
                </div>
                <div class="panel-body">
                    <p>As an inducted member, you are now able to introduce and induct new members to the space.</p>

                    <p>We have a crib sheet you can follow to give a tour. These are in an orange tray by the entrance, between
                        the main light switches and Woodwork doors.</p>

                    <p>The main themes to cover in the induction are as noted at the top of this page.</p>

                    <p>As we are ran by our members and reliant on volunteer effort, we try to emphasize how we are a
                        community and encourage new members to get involved however they can. Even the little things like
                        tidying up and taking the bins out are so helpful!</p>

                    <div class="alert alert-info">
                        <strong>General Induction code</strong>
                        <p>For members to prove they've attended a general induction, they will need to enter this code when
                            logged in on the members system.</p>
                        <div class="infobox__code text-center">{!! $general_induction_code !!}</div>
                        <div class="text-center">
                            <p><strong>Only share this code after the general induction.</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
