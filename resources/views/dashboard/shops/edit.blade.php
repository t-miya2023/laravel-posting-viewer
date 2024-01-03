@extends('layouts.admin')

@section('content')

<div class="container">
    <h2 class="mb-3">【管理画面】店舗情報編集</h2>
    <div class="row justify-content-center">
        <div class="col-10 d-flex flex-column">
            <form method="POST" action="{{ route('dashboard.shops.update',$shop->id) }}" enctype='multipart/form-data'>
                @csrf
                @method('Patch')
                <div class=mb-3>
                    <label class="form-label" for="">店舗名</label>
                    <input class="form-control" type="text" name="shop_name" value="{{$shop->shop_name}}">
                    @error('shop_name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class=mb-3>
                    <label class="form-label" for="">店舗説明</label>
                    <textarea class="form-control" name="shop_desc" cols="30" rows="5">{{ $shop->shop_desc }}</textarea>
                    @error('shop_desc')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
<div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="">郵便番号</label>
                    <input class="form-control" type="text" name="post_code" value="{{$shop->post_code}}" id="zip">
                    <button class="btn btn-primary mt-2" type="button" id="api-address">住所を自動入力</button>
                    @error('post_code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="">都道府県</label>
                    <select name="prefecture" class="form-control" id="prefecture">
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture }}" @if ($prefecture == $shop->prefecture) selected @endif>{{ $prefecture }}</option>
                        @endforeach
                    </select>                
                    @error('prefecture')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                </div>


                <div class="mb-3">
                    <label class="form-label" for="">住所（市町村から）</label>
                    <input class="form-control" type="text" name="address" id="address" value="{{$shop->address}}">
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">電話番号</label>
                    <input class="form-control" type="tel" name="tel" value="{{$shop->tel}}">
                    @error('tel')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">店舗メールアドレス</label>
                    <input class="form-control" type="email" name="shop_email" value="{{$shop->shop_email}}">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">営業時間</label>
                    <input class="form-control" type="text" name="business_hours" value="{{$shop->business_hours}}">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="">定休日</label>
                    <input class="form-control" type="text" name="holidays" value="{{$shop->holidays}}">
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-wrap">
                    <label class="form-label" for="">ジャンル</label>
                        @foreach ($genres as $genre)
                            <div class="d-flex align-items-center mt-3 me-3">
                                @if($shop->genres()->where('genre_id',$genre->id)->exists())
                                <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}" checked>
                                @else
                                <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}">
                                @endif
                                <span class="badge bg-secondary ms-1 fw-light">{{ $genre->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">店舗画像の変更</label>
                    <input class="form-control" type="file" name="shop_img" value="{{$shop->shop_img}}">
                </div>
                <div class="row">
                    <div class="mb-5 col-3">
                        <label class="form-label">現在の店舗画像</label>
                        @if($shop->shop_img)
                        <img class="w-100" src="{{ asset('storage/shop_img/' . $shop->shop_img) }}" alt="お店の外観">
                        @else
                        <img class="img-fluid" src="{{ asset('images/no-image.png') }}" alt="お店の外観">
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a class="btn btn-warning mx-5" href="{{route('dashboard.shops.index')}}">戻る</a>
                </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    <script src="{{asset('js/edit-api-address.js')}}"></script>
@endsection