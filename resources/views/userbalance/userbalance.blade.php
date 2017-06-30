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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Balance add</div>

                    Your balance details:
                    {{Auth::user()->find(Auth::user()->id)->balance}}

                </div>
            </div>
        </div>
    </div>
@endsection
