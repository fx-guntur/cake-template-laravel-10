@extends('customer.layout.partial.master')

@section('title', $pageTitle)

@section('content')
    @switch($viewType)
        @case('customerDashboard')
            @include('customer.content.home.index')
            @include('customer.content.home.show')
        @break

        @case('customerCheckout')
            @include('customer.content.checkout.index')
        @break

        @case('customerProductDetail')
            @include('customer.content.detail.index')
        @break

        @case('customerCart')
            @include('customer.content.cart.index')
        @break

        @case('customerProfile')
            @include('customer.content.profile.index')
        @break

        @case('customerCatalog')
            @include('customer.content.shop.index')
        @break

        @case('customerTestimonial')
            @include('customer.content.testimonial.index')
        @break

        @default
            <p>Content not found.</p>
    @endswitch
@endsection
