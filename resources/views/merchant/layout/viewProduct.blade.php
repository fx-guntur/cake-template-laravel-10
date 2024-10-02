@extends('merchant.layout.partial.master')
@section('title', 'Product Details')
@section('content')
    @include('merchant.content.panel.viewProduct', ['product' => $product])
@endsection
