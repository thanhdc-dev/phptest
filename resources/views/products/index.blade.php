@extends('layouts.admin')

@section('page-title')
<div class="d-flex justify-content-between">
    <nav aria-label="breadcrumb" style="flex: 1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </nav>
    <div style="margin-left: 10px">
        <a class="btn btn-success" href="{{ route('products.create') }}">Add</a>
    </div>
</div>
@endsection
@section('page-content')
    <table class="table table-hover mb-5">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th style="width: 145px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td class="text-center">{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img class="img-thumbnail" width="90"
                            src="{{ !empty($product->image_path) && file_exists(public_path('storage/' . $product->image_path)) ? asset('storage/' . $product->image_path) : 'images/image-not-available.png' }}"
                            alt="image-product">
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ route('products.show', $product->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $products->links() !!}
    </div>
@endsection
