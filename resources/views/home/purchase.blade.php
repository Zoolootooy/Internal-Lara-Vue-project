@extends('layouts.frontend')

@section('title', $page->link_name)

@section('content')
    <purchase-page
        make-order-route="{{route('makeOrder')}}"
        make-delivery-order-route="{{route('makeDeliveryOrder')}}"
        back-to-site-route="{{route('backToSite')}}"
        get-tags-route="{{route('getTags')}}"
        :product="{{ json_encode($product, JSON_UNESCAPED_UNICODE) }}"
        :extra-cards="{{ json_encode($extraCards, JSON_UNESCAPED_UNICODE) }}"
    ></purchase-page>
@endsection
