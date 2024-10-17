@extends('admin.layout.partial.master')
@section('title', 'Admin Panel')
@section('content')
@include('admin.content.show-data-merchant.index')
@include('admin.content.show-data-merchant.edit')
@endsection
