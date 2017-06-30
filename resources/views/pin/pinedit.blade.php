@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
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
                <h1 class="page-header">PIN Edit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        
        <!--Edit pin-->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pin Edit</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => Request::fullUrl(),'method' => 'PUT', 'class'=>'']) !!}
                        <div class="form-group">
                            <label for="status">Select operator</label>
                            {{ Form::select('operators', $operators, $pin->operator, array('class' => 'form-control', 'required' => 'required')) }}
                        </div>
                        <div class="form-group">
                        <label for="status"> Select state</label>
                            {{ Form::select('status', array(1 => 'Active', 0 => 'USED', -1 => 'DISABLED'), $pin->status, array('class' => 'form-control', 'required' => 'required')) }}
                        </div>
                        <div class="form-group">
                            <label for="serial_no"> Serial</label>
                            <input type="number" name="serial_no" id="serial_no" value="{{$pin->serial_no}}" class="form-control" required>
                            <label for="pin"> Pin</label>
                            <input type="number" name="pin" id="pin" value="{{$pin->pin}}" class="form-control" required>
                            <label for="amount"> Amount</label>
                            <input type="number" name="amount" id="amount" value="{{$pin->amount}}" class="form-control" required>
                            <label for="expiry_date"> Expiry date</label>
                            <input type="text" name="expiry_date" id="expiry_date" value="{{$pin->expiry_date}}" class="form-control" required>
                        </div>
                        <?php

                        echo Form::submit('Submit'); ?>
                        {!! Form::close() !!}             
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

