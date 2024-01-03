@extends('layouts.app')

@section('content')



<div class="container">

    <h2 class="mb-3">【管理画面】店舗レビュー一覧</h2>
    <div class="row justify-content-center">
        <div class="col-6">
            @if($reviews->isEmpty())
                <h4 class="m-5">まだ投稿はありません</h4>
            @endif
            @foreach($reviews as $review)
            <div class="p-3 border-bottom">
                <h3>店舗名:{{$review->shop->shop_name}}</h3>
                <h4>タイトル：{{$review->title}}</h4>
                <p>内容：{{$review->content}}</p>
                <p>点数：
                    @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                        <i class="bi bi-star-fill"></i>
                        @else
                        <i class="bi bi-star"></i>
                        @endif
                        @endfor
                </p>
                <a class="btn btn-primary" href="{{route('shops.reviews.edit',['review'=>$review->id,'shop'=>$review->shop->id])}}">編集する</a>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection