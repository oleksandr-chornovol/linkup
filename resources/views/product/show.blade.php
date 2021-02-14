@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div style="width: 80%; margin: 0 auto;">
        <h2 class="my-4">{{ $product->title }}</h2>
        <div class="my-5" style="display: flex">
            <img src="{{ $product->image_url }}" alt="img">
            <div style="margin: auto 0">
                <div class="mx-4 my-4" style="">{{ $product->docket }}</div>
                <h3 class="mx-4">{{ $product->price }} ₴</h3>
            </div>
        </div>
    </div>
@endsection
