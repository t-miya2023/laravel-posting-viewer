@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-3">レビュー投稿</h2>
    <div class="row">
        <div class="col-10 d-flex flex-column">
            <form method="POST" action="{{ route('shops.reviews.store',$shop->id) }}" enctype='multipart/form-data'>
                @csrf
                <div class=mb-3>
                    <label class="form-label" for="title">タイトル</label>
                    <input class="form-control" type="text" name="title">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="content">詳細</label>
                    <textarea class="form-control" name="content" rows="4"></textarea>
                    @error('content')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="rating">スコア</label>
                    <div class="rating p-3">
                        <i class="bi bi-star-fill" data-rating="1"></i>
                        <i class="bi bi-star" data-rating="2"></i>
                        <i class="bi bi-star" data-rating="3"></i>
                        <i class="bi bi-star" data-rating="4"></i>
                        <i class="bi bi-star" data-rating="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="1">
                </div>

                <button type="submit" class="btn btn-primary">投稿</button>
                <a class="btn btn-warning mx-5" href="{{route('shops.show',$shop->id)}}">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection