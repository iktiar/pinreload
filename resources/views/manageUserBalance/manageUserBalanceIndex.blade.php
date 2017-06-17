@extends('layouts.app')

@section('content')
   <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage User Balance</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
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
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">All User Balance</div>
                        @can('admin')
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="AllUserBalance">   
                              <thead>
                              <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($userBalances as $userBalance)
                                    <tr>
                                        <td>{{ $userBalance->id }}</td>
                                        <td>{{ $userBalance->name }}</td>
                                        <td>{{ $userBalance->email }}</td>
                                        <td><a href="/adduserbalance/{{ $userBalance->id }}">Assign Balance</a></td>
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
