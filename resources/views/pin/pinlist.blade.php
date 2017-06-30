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
                <h1 class="page-header">PINs Table</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                @can('admin')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ALL PINs
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="AllpinTables">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Serial No</th>
                                <th>Counrty</th>
                                <th>Operator</th>
                                <th>Amount</th>
                                <th>Pin</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pinlist as $pin)
                                <tr>
                                    <td>{{ $pin->id }}</td>
                                    <td>{{ $pin->serial_no }}</td>
                                    <td>{{ $pin->country }}</td>
                                    <td>{{ $pin->operator }}</td>
                                    <td>{{ $pin->amount }}</td>
                                    <td>{{ $pin->pin }}</td>
                                    <td>{{ $pin->expiry_date }}</td>
                                    <td>{{ $pin->status }}</td>
                                    <td><a href="pins/{{ $pin->id }}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        <!--add new pin-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Pin add</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => 'addpin']) !!}
                        Select operator
                        {{ Form::select('operators', $operators) }}
                        <br>
                        Select state
                        {{ Form::select('status', array(1 => 'Active', 0 => 'USED', -1 => 'DISABLED')) }}
                        <div class="form-group">
                            <label for="serial_no"> Serial</label>
                            <input type="number" name="serial_no" id="serial_no" value="" class="form-control" required>
                            <label for="pin"> Pin</label>
                            <input type="number" name="pin" id="pin" value="" class="form-control" required>
                            <label for="amount"> Amount</label>
                            <input type="number" name="amount" id="amount" value="" class="form-control" required>
                            <label for="expiry_date"> Expiry date</label>
                            <input type="date" name="expiry_date" id="expiry_date" value="" class="form-control"
                                   required>
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

