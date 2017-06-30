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
            <h1 class="page-header">Manage User Balance</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
        <div class="row">
            <div class="col-lg-12">

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
                        <div class="panel-heading">All User Balance
                        </div>
                        @can('admin')
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="AllUserBalance">   
                              <thead>
                              <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Group</th>
                              <th>Balance</th>
                              <th>Currency</th>
                              <th>Email</th>
                              <th>Status</th>
                              <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($userBalances as $userBalance)
                                    <tr>
                                        <td>{{ $userBalance->id }}</td>
                                        <td>{{ $userBalance->name }}</td>
                                        <td>{{ count($userBalance->roles) ? $userBalance->roles->first()->name : "n/a"}}</td>
                                        <td>{{ isset($userBalance->balance->balance) ? $userBalance->balance->balance : "n/a" }}</td>
                                        <td>{{ isset($userBalance->currency->currency) ? $userBalance->currency->currency : "n/a"}}</td>
                                        <td>{{ $userBalance->email }}</td>
                                        <td>{{ $userBalance->status }}</td>
                                        <td><a href="/adduserbalance/{{ $userBalance->id }}">Assign Balance</a> |
                                            @if($userBalance->status === "inactive" || 1)
                                            <a href="/setuserstatus/{{ $userBalance->id }}">Change Status</a>
                                            @endif
                                        </td>
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
    </div>    
@endsection
