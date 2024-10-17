@extends('merchant.layout.partial.master')
@section('title', 'Admin')
@section('content')
@include('merchant.content.transaction.index')
@include('merchant.content.transaction.show')
@endsection
