@extends('layouts.app')

@section('content')

<div class="container">
@if(session('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@endif
    <h2>{{$shop->shop_name}}</h2>
    <dl>
        <div class="d-flex">
            <dt>住所:</dt>
            <dd class="mx-2">{{$shop->prefecture}}{{$shop->address}}</dd>
        </div>
        <div class="d-flex">
            <dt>営業時間:</dt>
            <dd class="mx-2">{{$shop->business_hours}}</dd>
        </div>
        <div class="d-flex">
            <dt>定休日:</dt>
            <dd class="mx-2">{{$shop->holidays}}</dd>
        </div>
    </dl>
    <div class="row mb-5 justify-content-between">
        <div class="col-md-4">
            @if($shop->shop_img)
            <img class="img-fluid" src="{{ asset('storage/shop_img/' . $shop->shop_img) }}" alt="お店の外観">
            @else
            <img class="img-fluid" src="{{ asset('images/no-image.png') }}" alt="お店の外観">
            @endif
        </div>
        <div class="col-md-7 element-with-3d-border p-3">
            <h3 class="fw-bold">メニュー</h3>
                @if($menus->isEmpty())
                    <h4 class="m-5">まだメニューが登録されてません</h4>
                @else
                <table class="w-100">
                    <tr class="border-bottom d-flex justify-content-between">
                        <th class="p-2">メニュー名</th>
                        <th class="p-2">価格</th>
                    </tr>
                    @foreach($menus as $menu)
                    <tr class="border-bottom d-flex justify-content-between">
                        <td class="p-2">{{ $menu->menu }}</td>
                        <td class="p-2 text-danger">{{ $menu->price }}円</td>
                    </tr>
                    @endforeach
                </table>
                @endif
        </div>
    </div>
    <div class="row mb-3">
        <h3 class="fw-bold">詳細</h3>
        <p>{{$shop->shop_desc}}</p>
    </div>
    <div class="col-md-8 mb-5">
        <h3 class="mb-3 fw-bold">口コミ</h3>
        <i class="bi bi-star-fill">{{ $averageRating }}</i>
        @if($reviews->isEmpty())
            <h4 class="m-5">まだ投稿はありません</h4>
        @else
        @foreach($reviews as $review)
        <div class="m-5 border-bottom">
            <h4>{{$review->title}}</h4>
            <p>{{$review->content}}</p>
            <p>
                @for($i = 1; $i <= 5; $i++) 
                    @if($i <=$review->rating)
                        <i class="bi bi-star-fill"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                @endfor
            </p>
        </div>
        
        @endforeach
        @endif
        <div class="d-flex justify-content-between">
        <a class="btn btn-primary" href="{{route('shops.reviews.create',$shop->id)}}">投稿する</a>
        <a class="btn btn-primary" href="{{route('shop.reviews',$shop->id)}}">全てのレビューを見る<i class="bi bi-arrow-right fs-5 text-white"></i></a>
        </div>
    </div>


    <div class="row ">
        <div class="col-md-8">
            <h3 class="border-bottom pb-2">{{$shop->shop_name}}の店舗基本情報</h3>
            <table>
                <tr class="d-flex p-2 border-bottom">
                    <th>予約・お問い合わせ:</th>
                    <td class="mx-4">{{$shop->tel}}</td>
                    <td>{{$shop->shop_email}}</td>
                </tr>
                <tr class="d-flex p-2 border-bottom">
                    <th>ジャンル:</th>
                    <td class="mx-4">
                        @foreach($genres as $genre)
                            <span class="badge bg-secondary ms-1 fw-light">{{ $genre->title }}</span>
                        @endforeach
                    </td>
                </tr>
                <tr class="d-flex p-2 border-bottom">
                    <th>住所:</th>
                    <td class="mx-4">{{$shop->prefecture}}{{$shop->address}}</td>
                </tr>
                <tr class="d-flex p-2 border-bottom">
                    <th>営業時間:</th>
                    <td class="mx-4">{{$shop->business_hours}}</td>
                </tr>
                <tr class="d-flex p-2 border-bottom">
                    <th>定休日:</th>
                    <td class="mx-4">{{$shop->holidays}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection