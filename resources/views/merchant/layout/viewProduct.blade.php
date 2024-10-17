@extends('merchant.layout.partial.master')
@section('title', 'Product Details')
@section('content')
    @include('merchant.content.detail-product.index', ['product' => $product])
@endsection
