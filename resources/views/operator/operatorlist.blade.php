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
            <h1 class="page-header">Operators Table</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('admin')
            <div class="panel panel-default">
                <div class="panel-heading">
                    ALL Operators
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="AllpinTables">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Currency</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($operators as $operator)
                        <tr>
                            <td>{{ $operator->operatorId }}</td>
                            <td>{{ $operator->name }}</td>
                            <td>{{ $operator->country }}</td>
                            <td>{{ $operator->currency}}</td>
                            <td><a href="operator/{{ $operator->operatorId }}">Edit</a></td>
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
                <div class="panel-heading">Add new operator</div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'operator']) !!}
                    <div class="form-group">
                        <label for="countries">Select country</label>
                    {{ Form::select('countries', $countries) }}
                    </div>

                    <div class="form-group">
                        <label for="currencies">Select currency</label>
                        {{ Form::select('currencies', $currencies, null, ['id'=>'exchangeCountry', 'class'=>'form-control']) }}
                    </div>

                    <div class="form-group">
                        <label for="operator">Operator name</label>
                        <input type="text" name="operator" id="operator" value="" class="form-control" required>
                    </div>
                    <?php echo Form::submit('Submit'); ?>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

