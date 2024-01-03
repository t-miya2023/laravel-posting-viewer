@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="mb-3">【管理画面】店舗情報登録</h2>
    <div class="row justify-content-center">
        <div class="col-10 d-flex flex-column">
            <form method="POST" action="{{ route('dashboard.shops.store') }}" enctype='multipart/form-data'>
                @csrf
                <div class=mb-3>
                    <label class="form-label" for="shop_name">店舗名</label>
                    <input class="form-control" type="text" name="shop_name">
                    @error('shop_name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="shop_desc">店舗説明</label>
                    <textarea class="form-control" name="shop_desc" id="" cols="30" rows="5"></textarea>
                    @error('shop_desc')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="zip">郵便番号</label>
                        <input class="form-control" type="text" name="post_code" id="zip">
                        <button class="btn btn-primary mt-2" type="button" id="api-address">住所を自動入力</button>
                        @error('post_code')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">都道府県</label>
                        <select name="prefecture" class="form-control" id="prefecture">
                            <option value="" selected></option>
                            @foreach ($prefectures as $prefecture)
                            <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                            @endforeach
                        </select>
                        @error('prefecture')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>



                <div class="mb-3">
                    <label class="form-label" for="">住所（市町村から）</label>
                    <input class="form-control" type="text" name="address" id="address" value="">
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">電話番号</label>
                    <input class="form-control" type="tel" name="tel">
                    @error('tel')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">店舗メールアドレス</label>
                    <input class="form-control" type="email" name="shop_email">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">営業時間</label>
                    <input class="form-control" type="text" name="business_hours">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">定休日</label>
                    <input class="form-control" type="text" name="holidays">
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-wrap">
                        <label class="form-label" for="">ジャンル</label>
                        @foreach ($genres as $genre)
                        <div class="d-flex align-items-center mt-3 me-3">
                            <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}">
                            <span class="badge bg-secondary ms-1 fw-light">{{ $genre->title }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-5">
                    <label for="formFile" class="form-label">店舗画像</label>
                    <input class="form-control" type="file" name="shop_img">
                </div>

                <button type="submit" class="btn btn-primary">作成</button>
                <a class="btn btn-warning mx-5" href="{{route('dashboard.shops.index')}}">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/api-address.js')}}"></script>
@endsection