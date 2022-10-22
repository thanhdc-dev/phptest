@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="d-flex justify-content-between">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Page Not Found</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-error">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="error-template text-center">
                            <h1>Oops!</h1>
                            <h2>
                                404 Not Found</h2>
                            <div class="error-details">
                                Sorry, an error has occured, Requested page not found!
                            </div>
                            <div class="error-actions">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go Home </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
