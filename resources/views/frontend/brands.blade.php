@extends('layouts.frontend.app')

@section('title', 'Shopping Now')

@section('content')
<style>
    .shop-brand.shop-category .cat-row .cat-item img{
        width: 100%;
        height: 100px;
        padding: 0;
    }
    .shop-brand .title{
        text-align: left;
        margin: 0 !important;
    }
</style>
<div class="shop-category shop-brand" style="padding-bottom: 20px;text-align: center;">
    <div class="container">
        <div class="cat-row" style="display: flex; flex-wrap: wrap; justify-content: center;">
            @foreach ($brands as $keybrandx=>$brand)
            <a href="{{route('brand.product',['slug'=>$brand->slug])}}" class="cat-item" style="flex: 0 0 14%; box-sizing: border-box; margin-bottom: 20px;">
                <div style="margin-top: -20px;">
                    <div class="thumbnail" style="height: 240px; display: flex; justify-content: center; @if($keybrandx % 2 == 0) background: rgb(185, 194, 189,1.0); border-radius: 0px 80px 0px 0px @else background: rgb(222, 228, 224,1.0); border-radius: 0px 0px 80px 0px @endif">
                        <img src="{{asset('uploads/brand/'.$brand->cover_photo)}}" alt="" style="max-width: 100%; max-height: 100%;">
                    </div>
                    <h6 style="color:black; padding-top: 10px"><strong>{{ $brand->name }}</strong></h6>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection