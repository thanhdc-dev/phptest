@extends('layouts.admin')

@section('page-title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->code }}</li>
        </ol>
    </nav>
@endsection
@section('page-content')
    <div class="row">
        <div class="col-md-2">
            <p>Code</p>
        </div>
        <div class="col-md-4">
            {{ $product->code }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <p>Name</p>
        </div>
        <div class="col-md-4">
            {{ $product->name }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <p>Price</p>
        </div>
        <div class="col-md-4">
            {{ $product->price }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <p>Image</p>
        </div>
        <div class="col-md-4">
            @if (!empty($product->image_path) && file_exists(public_path('storage/' . $product->image_path)))
                <img class="img-thumbnail" width="80" src="{{ asset('storage/' . $product->image_path) }}"
                    alt="image-product">
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <p>Created At</p>
        </div>
        <div class="col-md-4">
            {{ $product->created_at->format('Y-m-d H:i:s') }}
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <p>Updated At</p>
        </div>
        <div class="col-md-4">
            {{ $product->updated_at->format('Y-m-d H:i:s') }}
        </div>
    </div>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('products.destroy', $product->id) }}"
        onsubmit="return confirm('Are you sure you wish to delete this record?');">
        @if ($product->id)
            {{ method_field('DELETE') }}
        @endif
        {!! csrf_field() !!}

        <div class="form-group">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </div>
        </div>
    </form>
@endsection
