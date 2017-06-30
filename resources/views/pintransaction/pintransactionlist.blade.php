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
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-md-12">
                @can('admin')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ALL transactions

                        {{$transactionlist}}
                    </div>
                    <!-- /.panel-heading -->
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="AllpinTables">
                            <thead>
                            <tr>
                                <th>ORDER ID</th>
                                <th>Serial No</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Operator</th>
                                <th>User ID</th>
                                <th>User Reference</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($transactionlist as $tli)
                                <tr>
                                    <td>{{ $tli->pinTransactionsId }}</td>
                                    <td>{{ $tli->serial_no }}</td>
                                    <td>{{ $tli->amount }}</td>
                                    <td>{{ $tli->status }}</td>
                                    <td>{{ $tli->operator }}</td>
                                    <td>{{ $tli->user_id }}</td>
                                    <td>{{ $tli->reference }}</td>
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
