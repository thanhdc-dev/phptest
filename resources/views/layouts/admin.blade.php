@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2 sidenav">
                <h4>Menu</h4>
                <ul class="nav nav-pills nav-stacked">
                    <li class="{{ (request()->is('home*')) ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                    <li class="{{ (request()->is('products*')) ? 'active' : '' }}"><a href="{{ route('products.index') }}">Product</a></li>
                </ul>
            </div>

            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('page-title')
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
    
                        @yield('page-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
