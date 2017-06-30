@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            @can('admin')
            <h1 class="page-header">PINs Upload</h1>
            @endcan
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                {{ Auth::user()->status === "inactive" ? "You are now inactive state" : "" }}

                @can('admin')
                <div class="panel-heading">Upload pin by csv file</div>
                   <div class="panel-body">
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
                        <form class="form-horizontal" method="post" action="/pins" enctype="multipart/form-data">
                             {{ csrf_field() }}
                             <div class="form-group">
                                <label for="fileupload" class="col-sm-2 control-label">Select File</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id=fileupload type="file" name="pinfile" accept=".csv" required/>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-default">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>
            @endcan
        </div>
    </div>
</div>
@endsection
