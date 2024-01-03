@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-3">レビュー編集</h2>
    <div class="row">
        <div class="col-10 d-flex flex-column">
            <form method="POST" action="{{ route('shops.reviews.update', ['shop' => $shop->id, 'review' => $review->id]) }}" enctype='multipart/form-data'>
                @csrf
                @method('Patch')
                <div class=mb-3>
                    <label class="form-label" for="title">タイトル</label>
                    <input class="form-control" type="text" name="title" value="{{$review->title}}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="content">詳細</label>
                    <textarea class="form-control" name="content" rows="4">{{$review->content}}</textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="rating">スコア</label>
                    <div class="rating p-3">
                        @for ($i = 1; $i <= 5; $i++) 
                            @if ($i <= $review->rating)
                            <i class="bi bi-star-fill" data-rating="{{ $i }}"></i>
                            @else
                            <i class="bi bi-star" data-rating="{{ $i }}"></i>
                            @endif
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" value="{{$review->rating}}">
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-warning mx-5" href="javascript:history.back()">戻る</a>
            </form>
            <div class="mt-5 text-end">
            @include('reviews.delete')
                <button class="btn btn-danger " type="button" data-bs-toggle="modal" data-bs-target="#deleteShopModal{{ $review->id }}">削除</button>
            </div>
            </div>
    </div>
</div>
@endsection