@extends('admin.layout.partial.master')
@section('title', 'Admin Panel')
@section('content')
@include('admin.content.show-data-transaction.index')
@include('admin.content.show-data-transaction.show')
@endsection
