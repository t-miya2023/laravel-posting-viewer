@extends('layouts.app')

@section('content')


<div class="container">
    <h2 class="mb-3">店舗一覧</h2>
    <div class="row justify-content-between">
        <div class="col-lg-2 ">

            <div class="row justify-content-center search-box">
                <div class="col-md-12 ">
                    <h3>検索</h3>
                    <form class="mb-5" id="search-form" action="{{ route('shops.index') }}" method="GET">
                        <div class="form-group">
                            <label for="shop_name">店舗名：</label>
                            <input type="text" name="shop_name" id="shop_name" class="form-control" value="{{ request('shop_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="title">ジャンル：</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ request('title') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="search_address">住所：</label>
                            <input type="text" name="search_address" id="search_address" class="form-control" value="{{ request('search_address') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="order_by">並び替え：</label>
                            <select name="order_by" id="order_by" class="form-control">
                                <option value="created_at" {{ request('order_by') === 'created_at' ? 'selected' : '' }}>新着順</option>
                                <option value="review_count" {{ request('order_by') === 'review_count' ? 'selected' : '' }}>評価件数順</option>
                                <option value="rating_high" {{ request('order_by') === 'rating_high' ? 'selected' : '' }}>評価順</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <select name="order_direction" id="order_direction" class="form-control">
                                <option value="desc" {{ request('order_direction') === 'desc' ? 'selected' : '' }}>降順</option>
                                <option value="asc" {{ request('order_direction') === 'asc' ? 'selected' : '' }}>昇順</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">絞り込む</button>
                        <button type="button" class="btn btn-danger mb-2" id="reset-btn">リセット</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if ($shops->isEmpty())
            <h2 class="text-center mt-5">該当する結果はありませんでした。</h2>
            @endif
            @foreach ($shops as $shop)
            <div class="row mb-3 border border-warning p-3 justify-content-center">
                <div class="col-md-3">
                    <a href="{{route('shops.show',$shop->id)}}" target="_blank" rel="noopener">
                        @if($shop->shop_img)
                        <img class="img-fluid" src="{{ asset('storage/shop_img/' . $shop->shop_img) }}" alt="お店の外観">
                        @else
                        <img class="img-fluid" src="{{ asset('images/no-image.png') }}" alt="お店の外観">
                        @endif
                    </a>
                </div>
                <div class="col-md-9 position-relative">
                    <h3 class="font-weight-bold border-bottom border-secondary d-inline-block mb-3">{{ $shop->shop_name }}</h3>
                    <p class="bg-light">{{ $shop->shop_desc }}</p>
                    <table>
                        <tr>
                            <th>住所：</th>
                            <td>{{ $shop->prefecture }}{{ $shop->address }}</td>
                        </tr>
                        <tr>
                            <th>電話番号:</th>
                            <td>{{ $shop->tel }}</td>
                        </tr>
                        <tr>
                            <th>ジャンル：</th>
                            <td>
                                @foreach($shop->genres as $genre)
                                <span class="badge bg-secondary ms-1 fw-light">{{ $genre->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>評判：</th>
                            <td>
                                <i class="bi bi-star-fill fs-5">
                                    {{ number_format($averageRatings[$shop->id],1) }}
                                    ({{ number_format($reviewCounts[$shop->id],0) }})
                                </i>    
                            </td>
                        </tr>
                    </table>
                    <a class="btn btn-warning position-absolute bottom-0 end-0" href="{{route('shops.show',$shop->id)}}" target="_blank" rel="noopener">詳細を見る</a>
                </div>
            </div>
            @endforeach
            {{ $shops->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') }} <!-- ページネーションリンクを表示 -->
        </div>

    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/reset-btn.js')}}"></script>
@endsection