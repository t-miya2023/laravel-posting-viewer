@extends('layouts.app')

@section('content')



<div class="container">

    <h2 class="mb-3">{{$shop->shop_name}}のレビュー一覧</h2>
    <div class="row justify-content-center">
        <div class="col-6">
            <i class="bi bi-star-fill">{{ $averageRating }}</i>
            @if($reviews->isEmpty())
                <h4 class="m-5">まだ投稿はありません</h4>
            @else
            @foreach($reviews as $review)
            <div class="p-3 border-bottom">
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
            </div>
            @endforeach
            @endif
        </div>
        
    </div>
    <a href="{{route('shops.show',$shop->id)}}" class="btn btn-warning mx-5">戻る</a>
</div>

@endsection