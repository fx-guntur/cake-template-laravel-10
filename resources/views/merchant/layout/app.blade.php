@extends('merchant.layout.partial.master')

@section('title', $pageTitle)

@section('content')
    @switch($viewType)
        @case('merchantTransactions')
            @include('merchant.content.transaction.index')
            @include('merchant.content.transaction.show')
            @break

        @case('merchantCategories')
            @include('merchant.content.category.create')
            @include('merchant.content.category.edit')
            @include('merchant.content.category.index')
            @break

        @case('merchantProducts')
            @include('merchant.content.product.index')
            @include('merchant.content.product.edit')
            @include('merchant.content.category.create')
            @include('merchant.content.product.show')
            @break

        @case('customerProfile')
            @include('merchant.content.form.profile')
            @break

        @case('merchantDashboard')
            @include('merchant.content.dashboard.index')
            @break

        @case('addCatalog')
            @include('merchant.content.form.add-catalog')
            @break

        @default
            <p>Content not found.</p>
    @endswitch
@endsection