@extends('layouts.app')

@section('content')
@if(session('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@endif
@if(session('welcome'))
    <div class="alert alert-success text-center">
        {{ session('welcome') }}
    </div>
@endif
<div class="position-relative">
    <img class="mainvisual" src="{{ asset('images/mainvisual3.png') }}" alt="">
    <div class="container mb-5">
        <div class="row justify-content-center top-search-box p-3">
            <div class="col-md-12 ">
                <h3>検索</h3>
                <p>探したい店舗の条件を入力してください。</p>
                <form id="search-form" action="{{ route('shops.index') }}" method="GET">
                    <div class="form-group">
                        <label for="shop_name">店舗名：</label>
                        <input type="text" name="shop_name" id="shop_name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="title">ジャンル：</label>
                        <input type="text" name="title" id="title" class="form-control" value="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="search_address">住所：</label>
                        <input type="text" name="search_address" id="search_address" class="form-control" value="">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">絞り込む</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container mb-3">
    <h2>地域から探す</h2>
    <div class="prefecture-list">
        @php
            $prefecturesWithLineBreak = ['北海道', '福島県','長野県','神奈川県','三重県','和歌山県','山口県','高知県']; // 改行を挿入したい地域のリスト
        @endphp
    @foreach($prefectures as $prefecture)
    <a class="text-decoration-none fs-5 px-3 my-3 border-end d-inline-block" href="{{ route('shops.index', ['selected_prefecture' => $prefecture]) }}">{{ $prefecture }}</a>
        @if (in_array($prefecture, $prefecturesWithLineBreak))
                <br>
            @endif
    @endforeach
    </div>
</div>

<div class="container mb-5">
    <h2>テーマから探す</h2>
    <div class="row">
        <div class="col-md-4 mb-2">
            <a href="{{ route('shops.index',['title' => 'ディナー']) }}">
                <img src="{{ asset('images/dinner.png') }}" class="img-fluid" alt="">
            </a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="{{ route('shops.index',['title' => 'ランチ']) }}">
                <img src="{{ asset('images/lanch.png') }}" class="img-fluid" alt="">
            </a>
        </div>
        <div class="col-md-4 mb-2">
            <a href="{{ route('shops.index',['title' => '日本酒']) }}">
                <img src="{{ asset('images/japanese.png') }}" class="img-fluid" alt="">
            </a>
        </div>
    </div>
</div>

<div class="text-center">
    <a href="{{ route('shops.index') }}" class="fs-2 border rounded-pill text-decoration-none p-2 border-info border-5 text-info">一覧表示</a>
</div>
@endsection