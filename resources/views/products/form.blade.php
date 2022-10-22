@extends('layouts.admin')

@section('page-title')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->id ? 'Edit' : 'Create' }}</li>
        </ol>
    </nav>
@endsection
@section('page-content')
    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
        action="{{ $product->id ? route('products.update', $product->id) : route('products.store') }}">
        @if ($product->id)
            {{ method_field('PUT') }}
        @endif
        {!! csrf_field() !!}

        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Code</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="code" value="{{ old('code', $product->code) }}">

                @if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Name</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label">Price</label>

            <div class="col-md-6">
                <input type="text" class="form-control" name="price" value="{{ old('price', $product->price) }}">

                @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

            <label class="col-md-2 control-label">Image</label>

            <div class="col-md-6">
                @if (!empty($product->image_path) && file_exists(public_path('storage/' . $product->image_path)))
                    <img class="img-thumbnail" width="80"
                    src="{{ asset('storage/' . $product->image_path) }}"
                    alt="image-product">
                @endif
                <input type="file" class="form-control" name="image">

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group mt-5">
            <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>

    </form>
@endsection
