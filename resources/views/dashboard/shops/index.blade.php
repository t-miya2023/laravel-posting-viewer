@extends('layouts.admin')

@section('content')



<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2 class="mb-3">【管理画面】店舗一覧</h2>
        <a class="btn btn-warning" href="{{route('dashboard')}}">
            <i class="bi bi-backspace fs-4"></i><span class="mx-2">管理画面メニューへ戻る</span>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="btn btn-primary d-block btn-lg mb-5" href="{{route('dashboard.shops.create') }}">新規店舗登録</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <h3>検索</h3>
            <form class="mb-5" action="{{ route('dashboard.shops.index') }}" method="GET">
                <div class="form-group">
                    <label for="shop_name">店舗名：</label>
                    <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ request('shop_name') }}">
                </div>
                <div class="form-group">
                    <label for="id">店舗ID：</label>
                    <input type="text" name="id" id="id" class="form-control" value="{{ request('id') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="search_address">住所：</label>
                    <input type="text" name="search_address" id="search_address" class="form-control" value="{{ request('search_address') }}">
                </div>
                <button type="submit" class="btn btn-primary">絞り込む</button>
            </form>
        </div>
    </div>




    <div class="row">

        <table>
            <div class="col-12">
                <tr class="border-bottom">
                    <th>店舗名</th>
                    <th>店舗ID</th>
                    <th>郵便番号</th>
                    <th>住所</th>
                    <th class="text-center">店舗詳細</th>
                    <th class="text-center">メニュー編集</th>
                    <th class="text-center">レビュー一覧</th>
                    <th class="text-center">編集</th>
                    <th class="text-center">削除</th>
                </tr>


                @foreach ($shops as $shop)

                <?php
                //郵便番号のフォーマット変換
                $postalCode = $shop->post_code;
                $formattedPostalCode = substr($postalCode, 0, 3) . '-' . substr($postalCode, 3);
                ?>

                <tr class="mb-5">
                    <th>{{$shop->shop_name}}</th>
                    <th>{{$shop->id}}</th>
                    <th>{{$formattedPostalCode}}</th>
                    <th>{{$shop->prefecture}}{{$shop->address}}</th>
                    <th class="text-center"><a class="btn btn-warning" href="{{route('dashboard.shops.show',$shop->id)}}" target="_blank" rel="noopener">店舗詳細</a></th>
                    <th class="text-center"><a class="btn btn-secondary" href="{{route('shops.menus.index',$shop->id)}}">メニュー編集</a></th>
                    <th class="text-center"><a class="btn btn-success" href="{{route('dashboard.shop.reviews',$shop->id)}}">レビュー一覧</a></th>
                    <th class="text-center"><a class="btn btn-primary" href="{{ route('dashboard.shops.edit', $shop) }}"><i class="bi bi-pencil fs-5 text-white"></i></a></th>
                    @include('dashboard.shops.delete')
                    <th class="text-center"><button class="btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#deleteShopModal{{ $shop->id }}"><i class="bi bi-trash fs-5 text-white"></i></button></th>
                </tr>
                @endforeach
            </div>
        </table>

    </div>

    @endsection