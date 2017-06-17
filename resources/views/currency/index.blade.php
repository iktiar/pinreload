@extends('layouts.app')

@section('content')
   <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Exchange Rate</h1>
        </div>
        <!-- /.col-lg-12 -->
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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Set exchange rate</div>
                    @can('admin')
                      <div class="panel-body">
                              
                              {!! Form::open(['url' => 'manageexchangerate','class'=>'form-horizontal']) !!}
                                  <div class="form-group">
                              <label class="col-sm-2 control-label" for="exchangeCountry">Set exchange rate</label>
                              <div class="col-sm-10"> 
                                      {{ Form::select('currencies', $currencies, null, ['id'=>'exchangeCountry', 'class'=>'form-control']) }}
                              </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-2 control-label" for="exchangeRate">Exchange rate</label>
                                  <div class="col-sm-10">
                                  <input type="text" name="exchangeRate" id="exchangeRate" value="" class="form-control">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-offset-2 col-sm-10">
                              
                              {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
                              
                               </div></div>
                         {!! Form::close() !!}
                      </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
