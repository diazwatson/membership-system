@extends('layouts.main')

@section('meta-title')
{{ $user->name }} - Manage your membership
@stop

@section('page-title')
    {{ $user->name }}<br />
    <small>{{ $user->email }}</small>
@stop


@section('page-key-image')
    {!! HTML::memberPhoto($user->profile, $user->hash, 100, '') !!}
@stop


@section('page-action-buttons')
    <a class="btn btn-secondary" href="{{ route('account.edit', [$user->id]) }}"><i class="material-icons">mode_edit</i> Edit</a>
    <a class="btn btn-secondary" href="{{ route('members.show', [$user->id]) }}"><i class="material-icons">person</i> View Profile</a>
@stop

@section('content')

@include('account.partials.member-status-bar')

@include('account.partials.alerts')

@include('account.partials.member-admin-action-bar')

@include('account.partials.get-started')

@if ($user->promoteGoCardless())

    <div class="row">
        <div class="col-xs-12 col-md-12">
            @include('account.partials.switch-to-gocardless-panel')
        </div>
    </div>

@endif

@if ($user->promoteVariableGoCardless())
    @include('account.partials.gocardless-variable-switch')
@endif


@if ($user->status == 'setting-up' && !$user->online_only)
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 pull-left">
            @include('account.partials.setup-panel')
        </div>
    </div>
@else

    @if ($user->online_only)
    <div class="row">
        <div class="col-xs-12 col-md-12 pull-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Online Only user</h3>
                </div>
                <div class="panel-body">
                    <h4>You're an online only user, and not a member of the space (yet).</h4>
                    <p>
                        To become a member, edit your account and mark yourself as not an online only member.
                        You'll need to add address details, emergency contact details, and setup a direct debit for the monthly subscription.
                    </p>
                    <a class="btn btn-secondary" href="{{ route('account.edit', [$user->id]) }}">
                        <i class="material-icons">mode_edit</i> 
                        Edit your account to become a member
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($user->status == 'left')
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 pull-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Member Left</h3>
                </div>
                <div class="panel-body">
                    <p>To rejoin please setup a direct debit for the monthly subscription.</p>
                    @include('account.partials.setup-payment')
                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($user->status == 'leaving')
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 pull-left">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Member Leaving</h3>
                </div>
                <div class="panel-body">
                    <p class="lead">
                        You're currently setup to leave Hackspace Manchester once your subscription payment expires.<br />
                        Once this happens you will no longer have access to the work space, mailing list or any other member areas.
                    </p>
                    <p>
                        If you wish to rejoin please use the payment options below
                    </p>
                    @include('account.partials.setup-payment')

                </div>
            </div>
        </div>
    </div>
    @endif

    @if ($user->isSuspended())
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 pull-left">
                @include('account.partials.payment-problem-panel')
            </div>
        </div>
    @endif

    @if (!$user->isSuspended() && !$user->online_only)
    <div class="row">
        <div class="col-xs-12 col-lg-12">
            @include('account.partials.induction-panel')
        </div>
    </div>
    @endif


    @if ($user->status != 'honorary' && !$user->online_only)

        <div class="row">
            <div class="col-xs-12 col-lg-12 pull-left">
                @include('account.partials.sub-charges')
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-lg-12 pull-left">
                @include('account.partials.payments-panel')
            </div>
        </div>

        {{-- Expenses functionality was removed... Uncomment this for testing. --}}
        {{--
        <div class="row">
            <div class="col-xs-12 col-lg-12 pull-left">
                <div id="memberExpenses" data-user-id="{{ $user->id }}"></div>
            </div>
        </div>
        --}}

        @if (($user->status != 'left') && ($user->status != 'leaving'))
        <div class="row">
            <div class="col-xs-12 col-lg-4">
                @include('account.partials.cancel-panel')
            </div>
        </div>
        @endif
    @endif

@endif


@include('account.partials.change-subscription-modal')

@stop
