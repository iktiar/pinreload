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
    <!--Edit Operator-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit operator</div>
                <div class="panel-body">
                    {!! Form::open(['url' => Request::fullUrl(),'method' => 'PUT', 'class'=>'']) !!}
                    <div class="form-group">
                    <label for="country">Select country</label>                    
                        {{ Form::select('countries', $countries, $operator->country, array('class' => 'form-control', 'required' => 'required')) }}
                    <br>

                        <div class="form-group">
                            <label for="currencies">Select currency</label>
                            {{ Form::select('currencies', $currencies, $operator->currency, ['id'=>'exchangeCountry', 'class'=>'form-control']) }}
                        </div>
                        <br>
                    <div class="form-group">
                        <label for="operator">Operator name</label>
                        <input type="text" name="operator" id="operator" value="{{$operator->name}}" class="form-control" required>
                    </div>
                    <?php echo Form::submit('Submit'); ?>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

