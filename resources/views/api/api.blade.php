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
            <h1 class="page-header">API DOC</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            @can('admin')
            <div class="panel panel-default">
                <!-- /.panel-heading -->
                <div class="panel-body">
                <div class="api-descritpion">
                
                <p>
                    <strong>URL - </strong>
                    http://bdpin.idlewilddigital.com/pinpullbyuser/OPERATOR/AMOUNT/REFERENCE/EMAIL/PASSWORD
                </p>

                <strong> Description </strong>
                <hr>          
                <p><strong> OPERATOR </strong> - Operator i.e. GP, Airtel etc. </p>
                <p><strong> AMOUNT </strong> - Amount requested </p>
                <p> <strong> REFERENCE </strong> - Random reference number</p>
                <p><strong> EMAIL</strong> - email of requested user </p>
                <p><strong> PASSWORD </strong>- Password of requested user </p>
                </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

</div>
@endsection

