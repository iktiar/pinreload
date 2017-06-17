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
                                <td>Edit</td>
                            </tr>
                      @endforeach 
                      </tbody>                 
                    </table>
                </div> 
            </div> 
            @endcan                   
        </div>
    </div>
</div>
@endsection

