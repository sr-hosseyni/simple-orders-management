@extends('layout/main')

@section('body')
    <section class="orders">
        <div id="order-form">
            @include('order/orders-form')
        </div>

        <div id="order-filter">
            @include('order/orders-filter')
        </div>

        <div id="order-list">
            @include('order/orders-list')
        </div>
    </section>
@endsection
