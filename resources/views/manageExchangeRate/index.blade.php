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
            
            <h1 class="page-header">PINs Table</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <div class="row">
            <div class="col-md-12">
                    <a href="/currency" class="btn btn-success pull-right">Add Exchange</a>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">All Exchange Rate</div>
                    @can('admin')
                        <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="AllExchangeRateTable">  
                              <thead>
                              <tr>
                              <th>SL</th>
                              <th>Currency Name</th>
                              <th>Exchange Rate</th>
                              <th>Created</th>
                              <th>Updated</th>
                              <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($exchangerate as $er)
                                    <tr>
                                        <td>{{ $er->exchangeRateId }}</td>
                                        <td>{{ $er->currencyName }}</td>
                                        <td>{{ $er->exchangeRate }}</td>
                                        <td>{{ $er->created_at }}</td>
                                        <td>{{ $er->updated_at }}</td>
                                        <td>Edit</td>
                                    </tr>
                              @endforeach 
                              </tbody>                 
                        </table>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection