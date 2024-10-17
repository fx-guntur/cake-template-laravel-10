@extends('merchant.layout.partial.master')
@section('title', 'merchant')
@section('content')
@include('merchant.content.product.index')
@include('merchant.content.product.edit')
@include('merchant.content.category.create')

@endsection
