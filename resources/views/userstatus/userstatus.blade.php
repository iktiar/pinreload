@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if (session('status'))
                    <div class="alert alert-success">

                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{$user}}
                        </div>

                        <div class="panel-body">
                            Select currency
                            {!! Form::open(['url' => 'setuserstatus']) !!}
                            {{ Form::select('currencies', $currencies, isset($currencies, $user->currency->currency) ? $user->currency->currency : "" ) }}
                            <br>
                            Select group
                            {{ Form::select('roles', $roles,  isset($user->roles->first()->name) ? $user->roles->first()->pivot->role_id : "") }}
                            <br>
                            Select status
                            {{ Form::select('status', array(['active' => 'active', 'inactive' => 'inactive']),  $user->status ) }}
                            <br>
                             <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}" class="form-control">
                            <?php echo Form::submit('Submit'); ?>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
