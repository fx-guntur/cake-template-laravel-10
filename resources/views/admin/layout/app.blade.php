@extends('admin.layout.partial.master')

@section('title', $pageTitle)

@section('content')
    @switch($viewType)
        @case('adminDashboard')
            @include('admin.content.dashboard.index')
        @break

        @case('adminCustomerData')
            @include('admin.content.show-data-customer.index')
        @break

        @case('adminMerchantData')
            @include('admin.content.show-data-merchant.index')
            @include('admin.content.show-data-merchant.edit')
        @break

        @case('adminTransactionData')
            @include('admin.content.show-data-transaction.index')
            @include('admin.content.show-data-transaction.show')
        @break

        @case('adminAddMerchant')
            @include('admin.content.daftar-merchant.create')
        @break

        @case('adminAddSeminar')
            @include('admin.content.add-seminar.add-seminar-event')
        @break

        @default
            <p>Content not found.</p>
    @endswitch
@endsection
