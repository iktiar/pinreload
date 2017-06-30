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
                    <div class="panel-heading">Balance add</div>
                    Name / balance / currency:  <br>
                    {{$user->name}} <br>
                       {{isset($user->balance->balance) ? $user->balance->balance : "" }}
                    <br>
                      {{isset($user->currency->currency) ? $user->currency->currency : "" }}
                    <div class="panel-body">
                       {!! Form::open(['url' => 'adduserbalance']) !!}
                            <div class="form-group">
                                <label for="exchangeRate"> amount</label>
                                 <input type="text" name="balance" id="balance" value="{{ old('balance') }}" class="form-control" required>
                                <label for="reference"> reference</label>
                                  <input type="text" name="reference" id="reference" value="{{ old('reference') }}" class="form-control" required>
                                <label for="password">password</label>
                                  <input type="password" name="password" id="password" value="" class="form-control" required>
                                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}" class="form-control">
                            </div>
                            <?php echo Form::submit('Submit'); ?>
                       {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
