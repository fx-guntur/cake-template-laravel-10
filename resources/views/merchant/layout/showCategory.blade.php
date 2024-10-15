@extends('merchant.layout.partial.master')
@section('title', 'merchant')
@section('content')
@include('merchant.content.category.create')
@include('merchant.content.category.edit')
@include('merchant.content.category.index')
@endsection
